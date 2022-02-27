<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Advertisement;
class MultiImg extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function advertisement(){
    	return $this->belongsTo(Advertisement::class,'advertisement_id','id');
    }
}
