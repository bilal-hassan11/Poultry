<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Company;
use App\Models\Item;
use App\Models\Flock;


use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getParentAccounts($id){
        $accounts = AccountType::where('parent_id', hashids_decode($id))->get();
        $html     = view('admin.common.parent_accounts', compact('accounts'))->render();

        return response()->json([
            'html'  => $html,
        ]);
    }

    public function get_companies($id){
        $companies = Company::where('category_id', hashids_decode($id))->get();
        $html     = view('admin.common.companies', compact('companies'))->render();

        return response()->json([
            'html'  => $html,
        ]);
    }

    public function get_flocks($id){
        $flocks = Flock::where('shade_id', hashids_decode($id))->get();
        $html     = view('admin.common.flocks', compact('flocks'))->render();

        return response()->json([
            'html'  => $html,
        ]);
    }

    public function get_items($id){
        $items = Item::where('company_id', hashids_decode($id))->get();
        $html     = view('admin.common.items', compact('items'))->render();

        return response()->json([
            'html'  => $html,
        ]);
    }

}
