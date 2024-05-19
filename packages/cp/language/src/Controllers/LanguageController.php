<?php
namespace Cp\Language\Controllers;

use Cp\Language\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function languageUpdateStatus(Language $language){
        request()->session()->put('locale', $language->language_code);
        $translate = 'Language Changed successfully';
        $success = 'success';
        // toast($translate, $success);
        return back();
    }
}
