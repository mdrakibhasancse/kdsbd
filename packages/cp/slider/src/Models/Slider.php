<?php

namespace Cp\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function fi_desktop()
    {
        return $this->image_desktop ?: 'not_found.png';
    }

    public function fi_mobile()
    {
        return $this->image_mobile ?: 'not_found.png';
    }
}