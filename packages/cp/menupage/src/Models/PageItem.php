<?php

namespace Cp\Menupage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; 

class PageItem extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'description'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }


    function localeName($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('name')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }


    function localeDescription($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('description')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }
}
