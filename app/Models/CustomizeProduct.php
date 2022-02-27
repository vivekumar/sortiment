<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mutimage(){
        return $this->hasMany(CustomizeMultimg::class,'customize_product_id','id');
    }
}
