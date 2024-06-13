<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PosModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'addedby_id',
        'active',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function moduleItems()
    {
    	return $this->hasMany(ModuleItem::class, 'pos_module_id');
    }


    public function moduleItemSubTotal()
    {
        return $this->moduleItems()
        ->sum('total_price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   

}