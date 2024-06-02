<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'addedby_id',
        'active',
    ];

    public function moduleItems()
    {
    	return $this->hasMany(ModuleItem::class, 'pos_module_id');
    }


    public function moduleItemSubTotal()
    {
        return $this->moduleItems()
        ->sum('total_price');
    }


   

}