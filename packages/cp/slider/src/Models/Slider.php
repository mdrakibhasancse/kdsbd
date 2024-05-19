<?php

namespace Cp\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function fi()
    {
        return $this->featured_image ?: 'not_found.png';
    }
}
