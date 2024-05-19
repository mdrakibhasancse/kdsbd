<?php

namespace Cp\Menupage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations; 

class Page extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'excerpt'];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_pages');
    }

    public function pageItems()
    {
        return $this->hasMany(PageItem::class, 'page_id', 'id');
    }
    
    public function activePageItems()
    {
        return $this->pageItems()->where('active', 1)->get();
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

    function localeNameShow() 
    {

        $a = json_decode(json_encode($this->getTranslations('name')), true);
        $code = app()->getLocale();

        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            
            else
            {
          
                foreach($a as $k => $item)
                {
                    if(array_key_exists($k, $a))
                    {
                        return $a[$k];
                    }
                }

            }
            
        }
    }

    

    function localeExcerpt($code) 
    {
        $a = json_decode(json_encode($this->getTranslations('excerpt')), true);
        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            return null;
            
        }
    }

    function localeExcerptShow() 
    {

        $a = json_decode(json_encode($this->getTranslations('excerpt')), true);
        $code = app()->getLocale();

        if($a)
        {
            if(array_key_exists($code, $a))
            {
                return $a[$code];
            }
            
            else
            {
                foreach($a as $k => $item)
                {
                    if(array_key_exists($k, $a))
                    {
                        return $a[$k];
                    }
                }

            }
            
        }
    }

}