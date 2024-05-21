<?php

use Cp\Language\Models\LanguageTranslation;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Cp\Product\Models\Cart;
use Cp\Product\Models\BranchArea;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
    @$size[$factor];
}


function is_image($mimeType)
{
  return starts_with($mimeType, 'image/');
}


function en2bnNumber($number)
{
  $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  $en_number = str_replace($search_array, $replace_array, $number);

  return $en_number;
}

function en2bnMonthName($name)
{
  $search_array = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $replace_array = array("জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");
  $result = str_replace($search_array, $replace_array, $name);

  return $result;
}

function en2bnDate($date)
{
  // $date = date("l, j F Y");
  $engDATE = array(
    '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'January', 'February', 'March', 'April',
    'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'
  );
  $bangDATE = array(
    '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', '
    বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'
  );
  $convertedDATE = str_replace($engDATE, $bangDATE, $date);
  return "$convertedDATE";
}

function menuSubmenu($menu, $submenu)
{
  $request = request();
  $request->session()->forget(['lsbm', 'lsbsm']);
  $request->session()->put(['lsbm' => $menu, 'lsbsm' => $submenu]);
  return true;
}


function bdMobile($mobile)
{
  $number = trim($mobile);
  $c_code = '880';
  $cc_count = strlen($c_code);

  if (substr($number, 0, 2) == '00') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '0') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '+') {
    $number = ltrim($number, '+');
  }
  if (substr($number, 0, $cc_count) == $c_code) {
    $number = substr($number, $cc_count);
  }
  if (substr($c_code, -1) == 0) {
    $number = ltrim($number, '0');
  }
  $finalNumber = $c_code . $number;

  return $finalNumber;
}

function bdMobileWithoutCode($mobile)
{
  $number = trim($mobile);
  $c_code = '0';
  $cc_count = strlen($c_code);
  if (substr($number, 0, 2) == '00') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '0') {
    $number = ltrim($number, '0');
  }
  if (substr($number, 0, 1) == '+') {
    $number = ltrim($number, '+');
  }
  if (substr($number, 0, $cc_count) == $c_code) {
    $number = substr($number, $cc_count);
  }
  if (substr($c_code, -1) == 0) {
    $number = ltrim($number, '0');
  }
  $finalNumber = $c_code . $number;
  return $finalNumber;
}




function bn2enNumber($number)
{
  $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
  $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  $en_number = str_replace($search_array, $replace_array, $number);

  return $en_number;
}



function localeNumber($number)
{
  if (app()->getLocale() == 'bn') {
    return en2bnNumber($number);
  } elseif (app()->getLocale() == 'en') {
    return $number;
  }
}




function translate($key, $lang = null, $addslashes = false)
{
  if ($lang == null) {
    $lang = App::getLocale();
  }

  $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

  $translations_en = Cache::rememberForever('translations-en', function () {
    return LanguageTranslation::where('lang', 'en')->pluck('lang_value', 'lang_key')->toArray();
  });

  if (!isset($translations_en[$lang_key])) {
    $translation_def = new LanguageTranslation;
    $translation_def->lang = 'en';
    $translation_def->lang_key = $lang_key;
    $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
    $translation_def->save();
    Cache::forget('translations-en');
  }

  // return user session lang
  $translation_locale = Cache::rememberForever("translations-{$lang}", function () use ($lang) {
    return LanguageTranslation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
  });


  if (isset($translation_locale[$lang_key])) {
    return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
  }



  // return default lang if session lang not found
  $translations_default = Cache::rememberForever('translations-' . env('DEFAULT_LANGUAGE', 'en'), function () {
    return LanguageTranslation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
  });
  if (isset($translations_default[$lang_key])) {
    return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
  }

  // fallback to en lang
  if (!isset($translations_en[$lang_key])) {
    return trim($key);
  }
  return $addslashes ? addslashes(trim($translations_en[$lang_key])) : trim($translations_en[$lang_key]);
}


function getSlug($title = Null, $model = Null, $edit = false)
{
  if (!is_null($title)) {
    $slug = "";
    if (!preg_match('/[^\x20-\x7e]/', $title)) {
      $slug = Str::slug($title);
    }
    $slug = empty($slug) ? generateSlug($title) : $slug;
    if (!$model == Null) {
      $exixts = $model->where('slug', $slug)->get();
      if (count($exixts) > 0 && !$edit) {
        $slug = $slug . '-' . time();
      }
    }
    return $slug;
  } else {
    return time();
  }
}

function generateSlug($title, $seperator = '-')
{
  $title = str_replace(['- ', ' -', ' '], $seperator, $title);
  $title = str_replace('@', 'AT', $title);
  $title = strip_tags($title);
  return trim($title);
}



function totalCartItems()
{
  if (Auth::check()) {
    $user_id = Auth::user()->id;
    $totalCartItems = Cart::where('user_id', $user_id)->sum('quantity');
  } else {
    $session_id = Session::get('session_id');
    $totalCartItems = Cart::where('session_id', $session_id)->sum('quantity');
  }
  return $totalCartItems;
}



function  totalCartAmount()
{
  if (Auth::check()) {
    $user_id = Auth::user()->id;
    $totalCart = Cart::where('user_id', $user_id)->get();
    $total_price = 0;
    foreach ($totalCart as $cart) {
      $total_price = $total_price + ($cart->product->final_price * $cart->quantity);
    }
  } else {
    $session_id = Session::get('session_id');
    $totalCart = Cart::where('session_id', $session_id)->get();
    $total_price = 0;
    foreach ($totalCart as $cart) {
      $total_price = $total_price + ($cart->product->final_price * $cart->quantity);
    }
  }
  return  $total_price;
}


function  totalDiscountCartAmount()
{
  if (Auth::check()) {
    $user_id = Auth::user()->id;
    $totalCart = Cart::where('user_id', $user_id)->get();
    $total_price = 0;
    foreach ($totalCart as $cart) {
      $total_price = $total_price + ($cart->product->discount * $cart->quantity);
    }
  } else {
    $session_id = Session::get('session_id');
    $totalCart = Cart::where('session_id', $session_id)->get();
    $total_price = 0;
    foreach ($totalCart as $cart) {
      $total_price = $total_price + ($cart->product->discount * $cart->quantity);
    }
  }
  return  $total_price;
}


function cartSessionToUser()
{
  $session_id = Session::get('session_id');
  if ($session_id) {
     Cart::where('session_id', $session_id)->update(['user_id' => Auth::id()]);
  }
}


function branchWiseOfferProducts(){

  $name = request()->cookie('area_name');
  $area = BranchArea::where('name_en',  $name)->first();
  if($area){
    $branch = $area->branch;
    $products = $branch->products()->where('discount', '>', 0.00)->count();
    return $products;
  }else{
    return  0;
  }
}


function smsUrl($to, $otp)
{
    
  $api = "b517e21388bc3207";
  $secret = "9b99568a";
  $sender = '01767506668';
  return "http://apismpp.ajuratech.com/sendtext?apikey={$api}&secretkey={$secret}&callerID={$sender}&toUser={$to}&messageContent={$otp}";
   
}