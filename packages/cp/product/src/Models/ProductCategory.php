<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductCategory extends Model
{
    use HasFactory;


    public function fi()
    {
        return $this->image ?: 'not_found.png';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'product_cats' , 'product_category_id' , 'product_id');
    }

    public function activeBranchProducts()
    {
       
        return $this->products()->latest()->take(10)->get();

        //  return BranchProduct::with('product')->where('branch_id',$branchId)->where('active',true)->take(20)->get();
    }



    

    public function subcategories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }

    public function activeSubCats()
    {
        return $this->hasMany(ProductSubCategory::class)->whereActive(true);
    }
}