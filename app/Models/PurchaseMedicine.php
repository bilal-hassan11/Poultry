<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DianujHashidsTrait;


class PurchaseMedicine extends Model
{
    use HasFactory, DianujHashidsTrait;

    protected $table = 'purchase_medicine';

    // public function item(){
    //     return $this->belongsTo(Item::class, 'item_id', 'id');
    // }
    
    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
