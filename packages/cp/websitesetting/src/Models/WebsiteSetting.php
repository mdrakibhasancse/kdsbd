<?php

namespace Cp\WebsiteSetting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;


    public function logo()
    {
        return $this->logo ?: 'logo.png';
    }

    public function logo_alt()
    {
        return $this->logo_alt ?: 'logo.png';
    }

    public function favicon()
    {
        return $this->favicon ?: 'logo.png';
    }

    public function footerImage()
    {
        return $this->footer_image ?: 'footer_img.png';
    }
}
