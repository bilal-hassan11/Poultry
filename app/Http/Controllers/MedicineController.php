<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function purchase_medicine(Request $req){
        $data = array(
            'title'     => 'Purchase Medicine',
            'accounts'  => Account::latest()->get(),
            
        );
        return view('admin.feed.purchase_medicine')->with($data);
    }

    public function sale_medicine(Request $req){
        $data = array(
            'title'     => 'Sale Medicine',
            'accounts'  => Account::latest()->get(),
            
        );
        return view('admin.feed.sale_medicine')->with($data);
    }
}
