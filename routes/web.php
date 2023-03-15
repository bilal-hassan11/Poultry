<?php
use Illuminate\Http\Request;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Administrator\AccountTypeController;
use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\SalesController;

use App\Http\Controllers\DetailViewController;  
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\Administrator\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\Administrator\HomeController;
use App\Http\Controllers\Administrator\StaffController;
use App\Http\Controllers\Administrator\DisciplineController;
use App\Http\Controllers\Administrator\FormulationController;
use App\Http\Controllers\Administrator\ItemController;
use App\Http\Controllers\Administrator\PermissionController;
use App\Http\Controllers\Administrator\ReportController;
use App\Http\Controllers\Administrator\SubjectController;
use App\Http\Controllers\Administrator\TopicController;
use App\Http\Controllers\Administrator\ManufactureItemController;

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\InwardController;
use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\OutwardController;

//New Controllers
use App\Http\Controllers\ShadeController;
use App\Http\Controllers\FlockController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ChickController;

use App\Models\Account;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => false, 'register' => true]);

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/', [HomeController::class, 'web'])->name('web');
Route::middleware('auth:admin')->prefix('web_admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Artisan Commands
    Route::prefix('artisan/command')->controller(ArtisanController::class)->name('artisan.command.')->group(function () {
        Route::get('/config_cache', 'config_cache')->name('config_cache');
        Route::get('/config_cache_clear', 'config_cache_clear')->name('config_cache_clear');
        Route::get('/route_cache', 'route_cache')->name('route_cache');
        Route::get('/route_cache_clear', 'route_cache_clear')->name('route_cache_clear');
        Route::get('/cache_clear', 'cache_clear')->name('cache_clear');
        Route::get('/route_list', 'route_list')->name('route_list');
        Route::get('/migrate', 'migrate')->name('migrate');
    });

    //Staffs routes
    Route::controller(StaffController::class)->prefix('staffs')->name('staffs.')->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{staff_id}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::post('/update_password', 'update_password')->name('update_password');
        Route::get('/update-status/{staff_id}', 'updateStatus')->name('update_status');
        Route::delete('/delete/{staff_id}', 'delete')->name('delete');

        //profile pages
        Route::get('/update-profile', 'update_profile')->name('update_profile');
        Route::post('/save-profile', 'save_profile')->name('save_profile');
        Route::post('/change-password', 'change_password')->name('change_password');
    });

    //Staffs routes
    Route::controller(StaffController::class)->prefix('staffs')->name('staffs.')->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{staff_id}', 'edit')->name('edit');
        Route::post('/save', 'save')->name('save');
        Route::post('/update_password', 'update_password')->name('update_password');
        Route::get('/update-status/{staff_id}', 'updateStatus')->name('update_status');
        Route::delete('/delete/{staff_id}', 'delete')->name('delete');

        //profile pages
        Route::get('/update-profile', 'update_profile')->name('update_profile');
        Route::post('/save-profile', 'save_profile')->name('save_profile');
        Route::post('/change-password', 'change_password')->name('change_password');
    });
    //permission routes
    Route::controller(PermissionController::class)->prefix('permission')->name('permissions.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/save', 'save')->name('save');
        Route::get('/delete/{permission_id}', 'delete')->name('delete'); 
    });

    //account type routes
    Route::controller(AccountTypeController::class)->prefix('account-type')->name('account_types.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //account routes
    Route::controller(AccountController::class)->prefix('accounts')->name('accounts.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/add/{grand_parent_id}/{parent_id}', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //category routes
    Route::controller(CategoryController::class)->prefix('category')->name('categories.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
    
    //Details 
    Route::controller(DetailViewController::class)->prefix('detial')->name('details.')->group(function(){
        Route::get('/', 'active_item')->name('active_item');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
    
    //orders
    Route::controller(OrderController::class)->prefix('order')->name('orders.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //item routes
    Route::controller(ItemController::class)->prefix('items')->name('items.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //consumption routes
    Route::controller(ConsumptionController::class)->prefix('consumption')->name('consumptions.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Sales BooK routes
    Route::controller(SalesController::class)->prefix('sale')->name('sales.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/account/{id}', 'accountDetails')->name('account_details');
        Route::get('/migrateToSale/{id}', 'migrateToSale')->name('migrate_to_sale');
        Route::get('/all-sales', 'allSales')->name('all_sales');
        Route::get('/edit_sale/{id}', 'editSale')->name('edit_sale');
        Route::post('/update-sale', 'updateSale')->name('update_sale');
        Route::get('/delete_sale/{id}', 'deleteSale')->name('delete_sale');
    });

    //Cash Book routes
    Route::controller(CashController::class)->prefix('cash')->name('cash.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/get-parent-accounts/{id}', 'getParentAccounts')->name('get_parent_accounts');
    });

    //Purchase Book routes
    Route::controller(PurchaseController::class)->prefix('purchase')->name('purchases.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/migrateToPurchase/{id}', 'migrateToPurchase')->name('migrate_to_purchase');
        Route::get('/all-purchase', 'allPurchase')->name('all_purchase');
        Route::get('/edit-purchase/{id}', 'editPurchase')->name('edit_purchase');
        Route::post('/update-purchase', 'updatePurchase')->name('update_purchase');
    });
    //report routes
    Route::controller(ReportController::class)->prefix('report')->name('reports.')->group(function(){
        Route::get('/item', 'itemReport')->name('item');
        Route::get('/item-pdf', 'itemReportPdf')->name('item_pdf');
        Route::get('/item-print', 'itemReportPrint')->name('item_print');

        Route::get('/account', 'accountReport')->name('account');
        Route::get('/account-pdf', 'accountReportPdf')->name('account_pdf');
        Route::get('/purchase-pdf', 'PurchaseReportPdf')->name('purchase_pdf');
        Route::get('/sale-pdf', 'SaleReportPdf')->name('sale_pdf');
        Route::get('/sale-print', 'SaleReportPrint')->name('sale_print');
        
        
        
        Route::get('/purchase-book', 'purchaseBookReport')->name('purchase_book');
        Route::get('/sale-book', 'saleBookReport')->name('sale_book');
        Route::get('/inward', 'inwardReport')->name('inward');
        Route::get('/inward-pdf', 'inwardReportPdf')->name('inward-pdf');
        Route::get('/inward-print', 'inwardReportPrint')->name('inward-print');

        //Route::post('/print', function() { return view('print'); });

        Route::get('/outward', 'outwardReport')->name('outward');
        Route::get('/outward-pdf', 'outwardReportPdf')->name('outward_pdf');
        Route::get('/outward-print', 'outwardReportPrint')->name('outward_print');



    });
    //formulation routes
    Route::controller(FormulationController::class)->prefix('formulation')->name('formulations.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/check-product-qty/{id}', 'checkProductQuantity')->name('check_product_qty');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete-row/{id}', 'deleteRow')->name('delete_row');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/view/{id}', 'view')->name('view');
    });
    // //Inward routes
    
    
    
    // //Outward routes
    // Route::controller(OutwardController::class)->prefix('report')->name('reports.')->group(function(){
    //     Route::get('/outward', 'index')->name('item');
    //     Route::get('/outward-pdf', 'outwardReportPdf')->name('outward_pdf');
        
    // });
    //common functions routes
    Route::controller(CommonController::class)->name('common.')->group(function(){
        Route::get('/get-parent-accounts/{id}', 'getParentAccounts')->name('get_parent_account');
    });


    //manufacture item
    Route::controller(ManufactureItemController::class)->prefix('manufacture-item')->name('manufactures.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //New Controllers 
    //Company 
    Route::controller(CompanyController::class)->prefix('company')->name('companys.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Chick 
    Route::controller(ChickController::class)->prefix('chick')->name('chicks.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/purchase_chick', 'purchase_chick')->name('purchase_chick');
        Route::post('/store-purchase-chick', 'storePurchaseChick')->name('purchase_store');
        Route::get('/edit-purchase-chick/{id}', 'editPurchaseChick')->name('purchase_edit');
        Route::get('/delete-purchase-chick/{id}', 'deletePurchaseChick')->name('purchase_delete');
        Route::get('/sale_chick', 'sale_chick')->name('sale_chick');
        Route::post('/store-sale-chick', 'storeSaleChick')->name('sale_store');
        Route::get('/edit-sale-chick/{id}', 'editSaleChick')->name('sale_edit');
        Route::get('/delete-sale-chick/{id}', 'deleteSaleChick')->name('sale_delete');
        // Route::post('/store', 'store')->name('store');
        // Route::get('/edit/{id}', 'edit')->name('edit');
        // Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Medicine 
    Route::controller(MedicineController::class)->prefix('medicine')->name('medicines.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/purchase_medicine', 'purchase_medicine')->name('purchase_medicine');
        Route::get('/sale_medicine', 'sale_medicine')->name('sale_medicine');
        
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Feed 
    Route::controller(FeedController::class)->prefix('feed')->name('feeds.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/purchase_feed', 'purchase_feed')->name('purchase_feed');
        Route::post('/store-purchase-feed', 'storePurchaseFeed')->name('purchase_store');
        Route::get('/edit-purchase-feed/{id}', 'editPurchaseFeed')->name('purchase_edit');
        Route::get('/delete-purchase-feed/{id}', 'deletePurchaseFeed')->name('purchase_delete');

        Route::get('/sale_feed', 'sale_feed')->name('sale_feed');
        Route::post('/store-sale-feed', 'storeSaleFeed')->name('sale_store');
        Route::get('/edit-sale-feed/{id}', 'editSaleFeed')->name('sale_edit');
        Route::get('/delete-sale-feed/{id}', 'deleteSaleFeed')->name('sale_delete');
        
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Flock 
    Route::controller(FlockController::class)->prefix('flock')->name('flocks.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    //Shade 
    Route::controller(ShadeController::class)->prefix('shade')->name('shades.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

});

Route::controller(InwardController::class)->prefix('inward')->name('inwards.')->group(function(){
    Route::get('/all_inward', 'index')->name('inward');
    Route::get('/get_inward', 'get_account')->name('get_account');
    Route::get('/get_items', 'get_items')->name('get_items');
    Route::get('/consumption', 'consumption')->name('consumption');

    
});

Route::post('/save_outward', [OutwardController::class, 'save_outward'])->name('save_outward');
//Weighbridge Outward
Route::controller(OutwardController::class)->prefix('outward')->name('outwards.')->group(function(){
    Route::get('/all_outward', 'index')->name('outward');
    Route::get('/save', 'save')->name('save');
    Route::get('/edit', 'edit')->name('edit');  
    Route::get('/edit_outward', 'edit_outward')->name('edit_outward');

    Route::get('/all_items', 'all_items')->name('all_items');
    Route::get('/all_accounts', 'all_accounts')->name('all_accounts');
    Route::get('/acc_id', 'acc_id')->name('acc_id');
    Route::get('/inward_report', 'inward_report')->name('inward_report');
    Route::get('/outward_report', 'outward_report')->name('outward_report');
    Route::get('/get_account', 'get_account')->name('get_account');
    Route::get('/get_item', 'get_item')->name('get_item');

    
});

//Weighbridge Inward
Route::controller(InwardController::class)->prefix('inward')->name('inwards.')->group(function(){
    Route::get('/all_inward', 'index')->name('inward');
    Route::get('/save', 'save')->name('save');
    Route::get('/edit', 'edit')->name('edit');  
    Route::get('/edit_inward', 'edit_inward')->name('edit_inward');

    Route::get('/all_items', 'all_items')->name('all_items');
    Route::get('/all_accounts', 'all_accounts')->name('all_accounts');

    
});

Route::prefix('cronjobs')->group(function () {
    Route::get('/{method}', [CronJobController::class, 'index']);
});
