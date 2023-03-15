<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseFeedRequest;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Models\Account;
use App\Models\Item;
use App\Models\Outward;
use App\Models\OutwardDetail;
use App\Models\SaleBook;
use App\Models\AccountLedger;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\PurchaseFeed;
use App\Models\SaleFeed;

class FeedController extends Controller
{
    public function purchase_feed(Request $req){
        $data = array(
            'title'             => 'Purchase Feeds',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Feed')->first(),
            'purchase_feed'     => PurchaseFeed::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
        );
        return view('admin.feed.purchase_feed')->with($data);
    }

    public function storePurchaseFeed(PurchaseFeedRequest $req){
        
        $validated = $req->validated();
        $item      = Item::findOrFail(hashids_decode($validated['item_id']));
        
        if(isset($validated['purchase_feed_id']) && !empty($validated['purchase_feed_id'])){//update the recrod
            $purchase = PurchaseFeed::findOrFail(hashids_decode($validated['purchase_feed_id']));
            $msg      = 'Purcahse feed updated successfully';
        }else{//add new record
            $purchase = new PurchaseFeed;
            $msg      = 'Purchase feed added successfully';
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
            'redirect'  => route('admin.feeds.purchase_feed')
        ]);
    }

    public function editPurchaseFeed($id){
        $data = array(
            'title'             => 'Purchase Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Feed')->first(),
            'purchase_feed'     => PurchaseFeed::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
            'edit_feed'         => PurchaseFeed::findOrFail(hashids_decode($id)),
            'is_updatee'        => true
        );
        return view('admin.feed.purchase_feed')->with($data);
    }

    public function deletePurchaseFeed($id){
        PurchaseFeed::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Purchase feed deleted successfully',
            'reload'    => true
        ]);
    }

    public function sale_feed(Request $req){
        $data = array(
            'title'     => 'Sale Feeds',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'sale_feed'       => SaleFeed::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),            
        );
        return view('admin.feed.sale_feed')->with($data);
    }

    public function storeSaleFeed(PurchaseFeedRequest $req){
        
        $validated = $req->validated();
        $item      = Item::findOrFail(hashids_decode($validated['item_id']));
        
        if(isset($validated['purchase_feed_id']) && !empty($validated['purchase_feed_id'])){//update the recrod
            $purchase = SaleFeed::findOrFail(hashids_decode($validated['purchase_feed_id']));
            $msg      = 'Sale feed updated successfully';
        }else{//add new record
            $purchase = new SaleFeed;
            $msg      = 'Sale feed added successfully';
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
            'redirect'  => route('admin.feeds.sale_feed')
        ]);
    }

    public function editSaleFeed($id){
        $data = array(
            'title'             => 'Sale Feed',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Feed')->first(),
            'sale_feed'         => SaleFeed::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),            
            'edit_feed'         => SaleFeed::findOrFail(hashids_decode($id)),
            'is_updatee'        => true
        );
        return view('admin.feed.sale_feed')->with($data);
    }
    
    public function deleteSaleFeed($id){
        PurchaseFeed::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Sale feed deleted successfully',
            'reload'    => true
        ]);
    }

    public function store(SaleRequest $req){
        // dd($req->all());
        // if(check_empty($req->sale_id)){
        //     $sale = SaleBook::findOrFail(hashids_decode($req->sale_id));
        //     $msg  = 'Sale updated successfully';
        // }else{
        //     $sale = new SaleBook();
        //     $msg  = 'Sale added successfully';
        // }
        // dd(array_sum($req->bags));
        $outward = Outward::findOrFail(hashids_decode($req->sale_id));//sale id is outward id here
        $sale = new SaleBook();
        $sale->date            = $req->sale_date;
        $sale->gp_no           = $req->gp_no;
        $sale->item_id         = $outward->id;//item id is outward id
        $sale->account_id      = hashids_decode($req->account_name);
        $sale->sub_dealer_name = $req->sub_dealer_name;
        $sale->vehicle_no      = $req->vehicle_no;
        $sale->bag_rate        = $req->bags_value;
        $sale->no_of_bags      = array_sum($req->bags);
        $sale->commission      = $req->commission;
        $sale->discount        = $req->discount;
        $sale->fare            = $req->fare_value;
        $sale->net_ammount     = $req->net_value;
        $sale->remarks         = $req->remarks;
        $sale->bilty_no        = 0;
        $sale->fare_status     = $req->fare_status;
        $sale->save();
        
        //Account Ledger
        $accountledger = new AccountLedger();

        // $id = SaleBook::latest('created_at')->first();
        $id    = SaleBook::find($sale->id);
        $accountledger->account_id = hashids_decode($req->account_name);
        $accountledger->sale_id          = $id->id;
        $accountledger->purchase_id      = 0;
        $accountledger->cash_id          = 0;
        $accountledger->debit            = $req->net_value ;
        $accountledger->credit           = 0 ;
        $accountledger->description      = $req->vehicle_no . ' '.$req->begs;
        $accountledger->save();
    
        return response()->json([
            'success' => 'Sale added successfully',
            'redirect'  => route('admin.sales.index'),
        ]);


    }

    public function edit($id){
        $data = array(
            'title'     => 'Sale Book',
            'accounts'  => Account::latest()->get(),
            'items'     => Item::latest()->get(),
            // 'sales'     => SaleBook::with(['item', 'account'])->latest()->get(),
            'outwards'  => Outward::with(['item', 'account'])->latest()->get(),
            'edit_sale' => Outward::with(['outardDetails', 'outardDetails.item'])->where('id',hashids_decode($id))->first(),
            // 'edit_sale' => Outward::with(['item', 'account'])->where('id',hashids_decode($id))->latest()->get(),
            // 'item_detail' => OutwardDetail::with(['item',])->where('outward_id',hashids_decode($id))->latest()->get(),
            // 'item_count' => OutwardDetail::with(['item',])->where('outward_id',hashids_decode($id))->latest()->count(),
            'is_update' => true,
        );
        //dd($data['item_detail']);
        return view('admin.sales_book.add_sale')->with($data);
    }

    public function delete($id){
        SaleBook::destroy(hashids_decode($id));

        return response()->json([
            'success'   => 'Sale delted successfully',
            'reload'    => true,
        ]);
    }

    public function accountDetails($id){
        $account = Account::findOrFail(hashids_decode($id));
        return response()->json([
            'account'   => $account
        ]);
    }

    public function migrateToSale($id){
        $outward = Outward::with(['outardDetails', 'account', 'outardDetails.item'])->findOrFail(hashids_decode($id));
        // dd($outward);
        $net_value  = 0;
        $discount   = 0;
        $commission = 0;

        foreach($outward->outardDetails AS $detail){
            $net_value += $detail->item->price * $detail->quantity;
        }

        $comimission = ($outward->account->commission * $net_value)/100;
        $discount    = ($outward->account->discount * $net_value)/100;
        $total       = ($net_value - ($discount+$comimission))-$outward->fare;

        $sale = new SaleBook();
        $sale->date            = $outward->date;
        $sale->gp_no           = $outward->gp_no;
        $sale->item_id         = $outward->id;//item id is outward id
        $sale->account_id      = $outward->account_id;
        $sale->sub_dealer_name = $outward->sub_dealer_name;
        $sale->vehicle_no      = $outward->vehicle_no;
        $sale->bag_rate        = $outward->bags_value;
        $sale->no_of_bags      = $outward->no_of_begs;
        $sale->commission      = $outward->account->commission;
        $sale->discount        = $outward->account->discount;
        $sale->fare            = $outward->fare;
        $sale->net_ammount     = $total;
        $sale->remarks         = $outward->remarks;
        $sale->bilty_no        = $outward->bilty_no;
        // $sale->fare_status     = $req->fare_status;
        $sale->save();

        return response()->json([
            'success'   => 'Row added to sales successfully',
            'reload'    => true,
        ]);
    }

    public function allSales(){
        
        $data = array(
            'title' => 'All sales',
            'sales'     => SaleBook::with(['outwardDetail.item'])->latest()->get(),
        );
        // dd($data['sales'][0]);
        return view('admin.sales_book.all_sales')->with($data);
    }

    public function editSale($id){
        $data = array(
            'title'     => 'Edit sale',
            'sales'     => SaleBook::with(['outwardDetail.item'])->latest()->get(),
            'edit_sale' => SaleBook::findOrfail(hashids_decode($id)),
            'accounts'  => Account::latest()->get(),
            'is_update' => true
        );
        return view('admin.sales_book.all_sales')->with($data);
    }

    public function updateSale(Request $req){
        
        $sale = SaleBook::findOrFail(hashids_decode($req->sale_book_id));
        
        $total_amount           = $sale->inward->item->price * $req->no_of_bags;
        $commission             = ($total_amount * $sale->account->commission)/100;
        $discount               = $req->no_of_bags * $sale->account->discount;
        $sale->date             = $req->date;
        $sale->gp_no            = $req->gp_no;
        $sale->vehicle_no       = $req->vehicle_no;
        $sale->account_id       = hashids_decode($req->account_id);
        $sale->sub_dealer_name  = $req->sub_dealer_name;
        $sale->no_of_bags       = $req->no_of_bags;
        $sale->bag_rate         = $req->bag_rate;
        $sale->fare             = $req->fare;
        $sale->net_ammount       = $total_amount - ($commission+$discount);
        $sale->save();

        return response()->json([
            'success'   => 'Sale book updated successfully',
            'redirect'  => route('admin.sales.all_sales')
        ]);
    }

    public function deleteSale($id){
        SaleBook::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Sale deleted successfully',
            'reload'    => true
        ]);
    }
}
