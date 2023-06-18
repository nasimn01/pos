<?php

namespace App\Models\Products;

use App\Models\Settings\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_price extends Model
{
    use HasFactory;

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
