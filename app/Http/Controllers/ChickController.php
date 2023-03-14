<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseChickRequest;
use App\Http\Requests\SaleChickRequest;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;
use App\Models\Companies;
use App\Models\Item;
use App\Models\PurchaseChick;
use App\Models\SaleChick;

class ChickController extends Controller
{
    // public function index(Request $req){
    //     $data = array(
    //         'title'     => 'chick',
    //         'accounts'  => Account::latest()->get(),
            
    //     );
    //     return view('admin.chick.purchase_chick')->with($data);
    // }

    public function purchase_chick(Request $req){
        $data = array(
            'title'             => 'Purchase Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'purchase_chicks'   => PurchaseChick::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
        );
        return view('admin.chick.purchase_chick')->with($data);
    }

    public function storePurchaseChick(PurchaseChickRequest $req){
        
        $validated = $req->validated();
        $item      = Item::findOrFail(hashids_decode($validated['item_id']));
        
        if(isset($validated['purchase_chick_id']) && !empty($validated['purchase_chick_id'])){//update the recrod
            $purchase = PurchaseChick::findOrFail(hashids_decode($validated['purchase_chick_id']));
            $msg      = 'Purcahse chick updated successfully';
        }else{//add new record
            $purchase = new PurchaseChick;
            $msg      = 'Purchase chick added successfully';
        }
        $purchase->date = $validated['date'];
        $purchase->company_id   = (int) hashids_decode($validated['company_id']);
        $purchase->item_id      = (int) hashids_decode($validated['item_id']);
        $purchase->account_id   = (int) hashids_decode($validated['account_id']);
        $purchase->rate         = (int) $item->price;
        $purchase->quantity     = (int) $validated['quantity'];
        $purchase->net_ammount  = (int) ($item->price * $validated['quantity']);
        $purchase->status       = $validated['status'];
        $purchase->remarks      = $validated['remarks'];
        $purchase->save();

        return response()->json([
            'success'   => $msg,
            'redirect'  => route('admin.chicks.purchase_chick')
        ]);

    }

    public function editPurchaseChick($id){
        $data = array(
            'title'             => 'Purchase Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'purchase_chicks'   => PurchaseChick::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
            'edit_purchase'     => PurchaseChick::findOrFail(hashids_decode($id)),
            'is_updatee'        => true
        );
        return view('admin.chick.purchase_chick')->with($data);
    }

    public function deletePurchaseChick($id){
        PurchaseChick::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Purchase chick deleted successfully',
            'reload'    => true
        ]);
    }

    public function sale_chick(Request $req){
        $data = array(
            'title'             => 'Sale Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'sale_chicks'       => SaleChick::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
        );
        return view('admin.chick.sale_chick')->with($data);
    }

    public function storeSaleChick(SaleChickRequest $req){
        
        $validated = $req->validated();
        $item      = Item::findOrFail(hashids_decode($validated['item_id']));
   
        if(isset($validated['sale_chick_id']) && !empty($validated['sale_chick_id'])){//update the recrod
            $sale = SaleChick::findOrFail(hashids_decode($validated['sale_chick_id']));
            $msg      = 'Sale chick updated successfully';
        }else{//add new record
            $sale = new SaleChick;
            $msg      = 'Sale chick added successfully';
        }
        $sale->date = $validated['date'];
        $sale->company_id   = (int) hashids_decode($validated['company_id']);
        $sale->item_id      = (int) hashids_decode($validated['item_id']);
        $sale->account_id   = (int) hashids_decode($validated['account_id']);
        $sale->rate         = (int) $item->price;
        $sale->quantity     = (int) $validated['quantity'];
        $sale->net_ammount  = (int) ($item->price * $validated['quantity']);
        $sale->status       = $validated['status'];
        $sale->remarks      = $validated['remarks'];
        $sale->save();

        return response()->json([
            'success'   => $msg,
            'redirect'  => route('admin.chicks.sale_chick')
        ]);

    }

    public function editSaleChick($id){
        $data = array(
            'title'             => 'Edit sale Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'sale_chicks'       => SaleChick::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
            'edit_sale'         => SaleChick::findOrFail(hashids_decode($id)),
            'is_update'         => true
        );
        return view('admin.chick.sale_chick')->with($data);
    }

    public function deleteSaleChick($id){
        SaleChick::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Sale chick deleted successfully',
            'reload'    => true
        ]);
    }
    // public function store(PurchaseRequest $req){
    //     //dd($req->purchase_id);
    //     if(check_empty($req->purchase_id)){
    //         $purchase = PurchaseBook::findOrFail(hashids_decode($req->purchase_id));
    //         $msg      = 'Purchase udpated successfully';
    //     }else{
    //         $purchase = new PurchaseBook();
    //         $msg      = 'Purchase added successfully';
    //     }
        
    //     $purchase->date              = $req->purchase_date;
    //     $purchase->vehicle_no        = $req->vehicle_no;
    //     $purchase->bilty_no          = $req->bilty_no;
    //     $purchase->pro_inv_no        = $req->prod_inv_no;
    //     $purchase->account_id        = hashids_decode($req->account_id);
    //     $purchase->item_id           = hashids_decode($req->item_id);
    //     $purchase->company_weight    = $req->company_weight;
    //     $purchase->party_weight      = $req->party_weight;
    //     $purchase->weight_difference = $req->weight_difference;
    //     $purchase->posted_weight     = $req->posted_weight;
    //     $purchase->bag_rate          = $req->rate;
    //     $purchase->fare              = $req->fare;
    //     $purchase->net_ammount       = $req->net_ammount;
    //     $purchase->remarks           = $req->remarks;
    //     $purchase->save();
        
    //     //Account Ledger
    //     $accountledger = new AccountLedger();
        
    //     $item = Item::findOrFail(hashids_decode($req->item_id));
    //     $item_name = $item->name;

    //     $account = Account::findOrFail(hashids_decode($req->account_id));
    //     $account_name = $account->name;

    //     $id = PurchaseBook::latest('created_at')->first();
    //     $accountledger->account_id = hashids_decode($req->account_id);
    //     $accountledger->sale_id          = 0;
    //     $accountledger->purchase_id      = $id->id;
    //     $accountledger->cash_id          = 0;
    //     $accountledger->debit            = 0;
    //     $accountledger->credit           = $req->net_ammount ;
    //     $accountledger->description      = 'Vehicle #'. $req->vehicle_no . ', Bilty # '.$req->bilty_no .',  Item:'.$item_name .',  Weight:'.$req->company_weight.'kg'.',  Posted Weight:'.$req->posted_weight.'kg'.',  Account #'.'['.$account->id.']'.$account->name;
    //     $accountledger->save();
    
    //     Item::find(hashids_decode($req->item_id))->increment('stock_qty', $req->company_weight);//increment item stock
        
    //     return response()->json([
    //         'success'   => $msg,
    //         'redirect'    => route('admin.purchases.index')
    //     ]);
        
    // }

    // public function edit($id){
    //     $data = array(
    //         'title'     => 'Purchase Book',
    //         'accounts'  => Account::latest()->get(),
    //         'items'     => Item::latest()->get(),
    //         'purchases' => PurchaseBook::with(['account', 'item'])->latest()->get(),
    //         'edit_purchase' => Inward::with(['item'])->findOrFail(hashids_decode($id)),
    //         'inwards'   => Inward::with(['account', 'item'])->latest()->get(),
    //         'is_update'     => true
    //     );
    //     return view('admin.purchase_book.add_purchase')->with($data);
    // }

    // public function delete($id){
    //     PurchaseBook::destroy(hashids_decode($id));
    //     return response()->json([
    //         'success'   => 'Purcahase deleted successfully',
    //         'reload'    => true
    //     ]);
    // }

    // // public function migrateToPurchase($id){
    // //     $inward          = Inward::findOrFail(hashids_decode($id));
    // //     $purchase        = new PurchaseBook;
    // //     $purchase_amount = $inward->item->price * $inward->	company_weight;
    // //     $commission      = $purchase_amount * $inward->account->commission;
    // //     $discount        = $inward->no_of_bags * $inward->account->discount;
    // //     $purchase_amount -= $inward->fare;
    // //     $purchase_amount -= ($commission+$discount);
        
    // //     $purchase->date              = $inward->date;
    // //     $purchase->vehicle_no        = $inward->vehicle_no;
    // //     $purchase->bilty_no          = $inward->bilty_no;
    // //     $purchase->pro_inv_no        = 0;
    // //     $purchase->account_id        = $inward->account_id;
    // //     $purchase->item_id           = $inward->id;
    // //     $purchase->company_weight    = $inward->company_weight;
    // //     $purchase->party_weight      = $inward->party_weight;
    // //     $purchase->weight_difference = $inward->weight_difference;
    // //     $purchase->posted_weight     = $inward->posted_weight;
    // //     $purchase->bag_rate          = $inward->rate;
    // //     $purchase->fare              = $inward->fare;
    // //     $purchase->net_ammount       = $purchase_amount;
    // //     $purchase->remarks           = $inward->remarks;
    // //     $purchase->save();

    // //     return response()->json([
    // //         'success'   => 'Inward data migrated to purchase book successfully',
    // //         'reload'    => true
    // //     ]);
    // // }
    // public function migrateToPurchase($id){

    //     $inward   = Inward::findOrFail(hashids_decode($id));
        
    //     $item = Item::findOrFail($inward->item_id);
    //     $item_name = $item->name;
    //     $item_rate = $item->price;

    //     $purchase        = new PurchaseBook;
    //     $purchase_amount = $inward->item->price * $inward->	company_weight;
    //     $get_commission = ($inward->account->commission /100) *  $purchase_amount ;
    //     $get_discount = $inward->account->discount * $inward->no_of_bags;
    //     $get_net_discount = $get_commission +  $get_discount ;
    //     //dd($get_net_discount);

    //     //$commission      = $purchase_amount * $inward->account->commission;
    //     //$discount        = $inward->no_of_bags * $inward->account->discount;
    //     $purchase_amount -= $inward->fare;
    //     $purchase_amount -= $get_net_discount;
        
    //     $purchase->date              = $inward->date;
    //     $purchase->vehicle_no        = $inward->vehicle_no;
    //     $purchase->bilty_no          = $inward->bilty_no;
    //     $purchase->pro_inv_no        = 0;
    //     $purchase->commission        = $get_commission;
    //     $purchase->discount          = $get_discount;
    //     $purchase->account_id        = $inward->account_id;
    //     $purchase->item_id           = $inward->id;
    //     $purchase->company_weight    = $inward->company_weight;
    //     $purchase->party_weight      = $inward->party_weight;
    //     $purchase->weight_difference = $inward->weight_difference;
    //     $purchase->posted_weight     = $inward->posted_weight;
    //     $purchase->no_of_bags        = $inward->no_of_bags;
    //     $purchase->bag_rate          = $inward->rate;
    //     $purchase->fare              = $inward->fare;
    //     $purchase->net_ammount       = $purchase_amount;
    //     $purchase->remarks           = $inward->remarks;
    //     $purchase->save();

    //     //Account Ledger
    //     $accountledger = new AccountLedger();
       
    //     $account = Account::findOrFail($inward->account_id);
    //     $account_name = $account->name;

    //     $id = PurchaseBook::latest('created_at')->first();
    //     $accountledger->account_id = $inward->account_id;
    //     $accountledger->sale_id          = 0;
    //     $accountledger->purchase_id      = $id->id;
    //     $accountledger->cash_id          = 0;
    //     $accountledger->debit            = $purchase->net_ammount;
    //     $accountledger->credit           = 0;
    //     $accountledger->description      = 'Vehicle #'. $inward->vehicle_no . ', Bilty # '.$inward->bilty_no .',  Item:'.$item_name .',  Weight:'.$inward->company_weight.'kg'.',  Posted Weight:'.$inward->posted_weight.'kg'.',  Account #'.'['.$account->id.']'.$account->name;
    //     $accountledger->save();
    
    //     Item::find($inward->item_id)->increment('stock_qty', $inward->company_weight);//increment item stock

    //     return response()->json([
    //         'success'   => 'Inward data migrated to purchase book successfully',
    //         'reload'    => true
    //     ]);
    // }

    // public function allPurchase(){
    //     $data = array(
    //         'title' => 'All purchase',
    //         'purchases'  => PurchaseBook::with(['inward.item'])->latest()->get(),
    //     );
    //     // dd($data['purchases'][0]);
    //     return view('admin.purchase_book.all_purchase')->with($data);
    // }

    // public function editPurchase($id){
    //     $data = array(
    //         'title'         => 'Edit purchase',
    //         'purchases'     => PurchaseBook::with(['inward.item'])->latest()->get(),
    //         'edit_purchase' => PurchaseBook::findOrFail(hashids_decode($id)),
    //         'accounts'      => Account::latest()->get(),
    //         'is_update'     => true  
    //     );
    //     return view('admin.purchase_book.all_purchase')->with($data);
    // }

    // public function updatePurchase(Request $req){
        
    //     $sale = PurchaseBook::findOrFail(hashids_decode($req->purchase_book_id));
    //     $sale->date             = $req->date;
    //     $sale->pro_inv_no       = $req->pro_inv_no;
    //     $sale->vehicle_no       = $req->vehicle_no;
    //     $sale->account_id       = hashids_decode($req->account_id);
    //     // $sale->sub_dealer_name  = $req->sub_dealer_name;
    //     $sale->no_of_bags       = $req->no_of_bags;
    //     $sale->bag_rate         = $req->bag_rate;
    //     $sale->fare             = $req->fare;
    //     $sale->save();

    //     return response()->json([
    //         'success'   => 'purchase book updated successfully',
    //         'redirect'  => route('admin.sales.all_sales')
    //     ]);
    // }
}
