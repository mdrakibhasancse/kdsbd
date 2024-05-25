<?php

namespace Cp\Product\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cp\Product\Models\OrderItem;

class Product extends Model
{
    use HasFactory;


    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_cats', 'product_id', 'product_category_id');
    }


    public function subcategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'product_subcats', 'product_id', 'product_subcategory_id');
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_products', 'product_id', 'branch_id');
    }


    public function branchesWiseproducts()
    {
        return $this->branches()->withPivot('active');
    }


    public function cart()
    {
        return $this->hasOne(Cart::class);
    }


    public function items()
    {
       return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function hasItem($branch, $order)
    {
       return (bool) $this->items()->where('branch_id', $branch)->where('order_id', $order)->count();
    }

   
}