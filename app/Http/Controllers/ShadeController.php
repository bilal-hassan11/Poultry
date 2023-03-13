<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShadeRequest;
use App\Models\Account;
use App\Models\Staff;
use App\Models\Shade;


class ShadeController extends Controller
{
    public function index(Request $req){
        $data = array(
            'title'     => 'Shade',
            'accounts'  => Account::latest()->get(),
            'staff' => Staff::where('user_type','supervisor')->latest()->get(),
            'shade' => Shade::with(['staff'])->latest()->get(),

            
        );
        return view('admin.shade.add_shade')->with($data);
    }
    

    public function store(ShadeRequest $req){
        //dd($req->all());

        if(check_empty($req->shade_id)){
            $shade = Shade::findOrFail(hashids_decode($req->shade_id));
            $msg      = 'Shade udpated successfully';
        }else{
            $shade = new Shade();
            $msg      = 'Shade added successfully';
        }
        
        $shade->date              = $req->date;
        $shade->staff_id          = hashids_decode($req->staff_id);
        $shade->name              = $req->name;
        $shade->status            = $req->status;
        $shade->address           = $req->address;
        $shade->save();
        
        
        return response()->json([
            'success'   => $msg,
            'redirect'    => route('admin.shades.index')
        ]);
        
    }

    public function edit($id){
        $data = array(
            'title'     => 'Edit Shade',
            'accounts'  => Account::latest()->get(),
            'staff' => Staff::where('user_type','supervisor')->latest()->get(),
            'shade' => Shade::with(['staff'])->latest()->get(),   
            'edit_shade' => Shade::with(['staff'])->findOrFail(hashids_decode($id)),
            'is_update'     => true
        );
        return view('admin.shade.add_shade')->with($data);
    }

    public function delete($id){
        Shade::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Shade deleted successfully',
            'reload'    => true
        ]);
    }

   
}
