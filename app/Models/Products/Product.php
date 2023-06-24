<?php

namespace App\Models\Products;

use App\Models\Settings\Unit;
use App\Models\Settings\Unit_style;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function childcategory(){
        return $this->belongsTo(Childcategory::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function unitStyle(){
        return $this->belongsTo(Unit_style::class);
    }
    public function product_price(){
        return $this->hasMany(Product_price::class);
    }
    
}
