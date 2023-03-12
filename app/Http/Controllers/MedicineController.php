<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use App\Models\Account;
use App\Models\Item;
use App\Models\Outward;
use App\Models\OutwardDetail;
use App\Models\SaleBook;
use App\Models\AccountLedger;
use App\Models\AccountType;


class MedicineController extends Controller
{
    public function purchase_medicine(Request $req){
        $data = array(
            'title'     => 'Purchase Medicine',
            'accounts'  => Account::latest()->get(),
            
        );
        return view('admin.medicine.purchase_medicine')->with($data);
    }

    public function sale_medicine(Request $req){
        $data = array(
            'title'     => 'Sale Medicine',
            'accounts'  => Account::latest()->get(),
            
        );
        return view('admin.medicine.sale_medicine')->with($data);
    }
}
