<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FlockRequest;
use App\Models\Account;
use App\Models\Flock;
use App\Models\Shade;



class FlockController extends Controller
{
    public function index(Request $req){
        $data = array(
            'title'     => 'Flock',
            'accounts'  => Account::latest()->get(),
            'shade' => Shade::latest()->get(),
            'flock' => Flock::with(['shade'])->latest()->get(),

            
        );
        return view('admin.flock.add_flock')->with($data);
    }

    public function store(FlockRequest $req){
        //dd($req->all());

        if(check_empty($req->flock_id)){
            $flock = Flock::findOrFail(hashids_decode($req->flock_id));
            $msg      = 'Flock udpated successfully';
        }else{
            $flock = new Flock();
            $msg      = 'Flock added successfully';
        }
        
        $flock->starting_date              = $req->starting_date;
        $flock->shade_id          = hashids_decode($req->shade_id);
        $flock->name              = $req->name;
        $flock->status            = $req->status;
        $flock->save();
        
        
        return response()->json([
            'success'   => $msg,
            'redirect'    => route('admin.flocks.index')
        ]);
        
    }

    public function edit($id){
        $data = array(
            'title'     => 'Edit Flock',
            'accounts'  => Account::latest()->get(),
            'shade' => Shade::latest()->get(),
            'flock' => Flock::with(['shade'])->latest()->get(),
            'edit_flock' => Flock::with(['shade'])->findOrFail(hashids_decode($id)),
            'is_update'     => true
        );
        return view('admin.flock.add_flock')->with($data);
    }

    public function delete($id){
        Flock::destroy(hashids_decode($id));
        return response()->json([
            'success'   => 'Flock deleted successfully',
            'reload'    => true
        ]);
    }

}
