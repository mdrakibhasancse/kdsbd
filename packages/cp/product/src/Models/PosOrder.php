<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PosOrder extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(PosOrderItem::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}