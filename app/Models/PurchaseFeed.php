<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DianujHashidsTrait;


class PurchaseFeed extends Model
{
    use HasFactory, DianujHashidsTrait;

    protected $table = 'purchase_feed';

    // public function item(){
    //     return $this->belongsTo(Item::class, 'item_id', 'id');
    // }
}
