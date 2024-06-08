<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
       
    }

    public function due()
    {
        return $this->total_amount - $this->payments()->sum('paid_amount');
       
    }

    public function paid()
    {
        return  $this->payments()->sum('paid_amount');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}