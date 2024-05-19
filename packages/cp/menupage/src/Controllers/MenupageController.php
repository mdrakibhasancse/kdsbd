<?php

namespace Cp\Menupage\Controllers;

use Auth;
use Event;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use Cp\Menupage\Models\Menu; 
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
class MenupageController extends Controller
{ 
    public function myMenupage($value='')
    {
    	return view('menupage::menu.welcome');
    }
}