<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function products()
    {
       return $this->belongsToMany(Product::class , 'product_subcats' , 'product_subcategory_id' , 'product_id');
    }



    public function fi()
    {
        return $this->image ?: 'not_found.png';
    }
}