<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cp\Product\Models\Branch;

class BranchArea extends Model
{
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo(branch::class);
    }
}