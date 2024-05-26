<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Upazila::class, 'thana_id', 'id');
    }

    public function branchAreas()
    {
        return $this->hasMany(BranchArea::class, 'branch_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_products', 'branch_id', 'product_id');
    }


    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'branch_cats', 'branch_id', 'category_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'branch_subcats', 'branch_id', 'subcategory_id');
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'branch_id');
    }
}