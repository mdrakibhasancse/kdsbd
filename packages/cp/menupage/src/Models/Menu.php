<?php

namespace Cp\Menupage\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    // use SoftDeletes;
    // protected $table = 'menus';
    // protected $fillable = [];

    // protected $dates = ['deleted_at'];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'menu_pages');
    }

    public function latestPages()
    {
        return $this->pages()->orderBy('drag_id')->whereActive(true)->latest()->get();
    }
}