<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DianujHashidsTrait;


class Companies extends Model
{
    use HasFactory, DianujHashidsTrait;

    protected $table = 'companies';

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
