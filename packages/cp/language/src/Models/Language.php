<?php

namespace Cp\Language\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function translations(){
        return $this->hasMany(LanguageTranslation::class, 'lang', 'language_code');
    }
}
