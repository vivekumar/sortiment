<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mutimage(){
        return $this->hasMany(MultiImg::class,'product_id','id');
    }
    public function product_attributes(){
        return $this->hasMany('App\Models\ProductAttribute','product_id');
    }
    public function product_categories(){
        return $this->hasMany('App\Models\ProductCategory','product_id');
    }
    public function product_sub_categories(){
        return $this->hasMany('App\Models\ProductSubCategory','product_id');
    }
}
