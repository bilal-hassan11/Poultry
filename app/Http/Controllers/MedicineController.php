<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseMedicineRequest;
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
use App\Models\PurchaseMedicine;

class MedicineController extends Controller
{
    public function purchase_medicine(Request $req){
        $data = array(
            'title'     => 'Purchase Medicine',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'purchase_medicines'     => PurchaseMedicine::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
            
        );
        return view('admin.medicine.purchase_medicine')->with($data);
    }

    public function storePurchaseMedicine(PurchaseMedicineRequest $req){
        
        $validated = $req->validated();
     
        if(isset($validated['purchase_medicine_id']) && !empty($validated['purchase_medicine_id'])){//update the recrod
            $purchase = PurchaseMedicine::findOrFail(hashids_decode($validated['purchase_medicine_id']));
            $msg      = 'Purcahse medicine updated successfully';
        }else{//add new record
            $purchase = new PurchaseMedicine;
            $msg      = 'Purchase medicine added successfully';
        }
        $purchase->date             = $validated['date'];
        $purchase->company_id       = (int) hashids_decode($validated['company_id']);
        $purchase->item_id          = (int) hashids_decode($validated['item_id']);
        $purchase->account_id       = (int) hashids_decode($validated['account_id']);
        $purchase->rate             = (int) $validated['rate'];
        $purchase->quantity         = (int) $validated['quantity'];
        $purchase->net_ammount      = (int) ($validated['net_ammount']);
        $purchase->purchase_ammount  = (int) ($validated['purchase_ammount']);
        $purchase->commission       = (int) ($validated['commission']);
        $purchase->discount         = (int) ($validated['discount']);
        $purchase->status           = $validated['status'];
        $purchase->remarks          = $validated['remarks'];
        $purchase->save();

        return response()->json([
            'success'   => $msg,
            'redirect'  => route('admin.medicines.purchase_medicine')
        ]);
    }

    public function editPurchaseMedicine($id){
        $data = array(
            'title'             => 'Purchase Chicks',
            'accounts'          => Account::latest()->get(),
            'category'          => Category::with(['companies', 'items'])->where('name', 'Chick')->first(),
            'purchase_medicines'=> PurchaseMedicine::with(['company:id,name','account:id,name','item:id,name'])->latest()->get(),
            'edit_medicine'         => PurchaseMedicine::findOrFail(hashids_decode($id)),
            'is_update'        => true
        );
        return view('admin.medicine.purchase_medicine')->with($data);
    }

    public function deletePurchaseFeed($id){
        PurchaseMedicine::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Purchase medicine deleted successfully',
            'reload'    => true
        ]);
    }
    public function sale_medicine(Request $req){
        $data = array(
            'title'     => 'Sale Medicine',
            'accounts'  => Account::latest()->get(),
            
        );
        return view('admin.medicine.sale_medicine')->with($data);
    }
}
