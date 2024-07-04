<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cp\Product\Models\Product;
use Carbon\Carbon;

class BranchDeal extends Model
{
    use HasFactory;

    protected $dates = ['expired_date'];

    public function fi()
    {
        return $this->image ?: 'not_found.png';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_deal_items', 'deal_id', 'product_id');
    }

    
}