<?php

namespace Cp\Admin\Controllers;

use Auth;
use Event;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Cp\Frontend\Models\ContactUs;
use Illuminate\Http\Request;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        menuSubmenu('dashboard', 'dashboard');
        return view('admin::dashboard.dashboard');
    }


    public function themeChange(Request $request){

        $ws = WebsiteSetting::first();
        if(($request->theme == 1) or ($request->theme == 2))
        {
            $ws->theme = $request->theme;
            $ws->save();
            cache()->flush();
            toast('Your website theme successfully changed', 'success');
            return redirect()->back();
        }
        else
        {
            return back();
        }
    }



    public function contactsAll()
    {
        menuSubmenu('contact', 'contactsAll');
        $data['allContacts'] = ContactUs::paginate(50);
        return view('frontend::admin.contacts.contactsAll', $data);
    }

    public function contactDelete($id)
    {
        $ContactUs = ContactUs::find($id);
        $ContactUs->delete();
        return back()->with("success", "ContactUs Delated Successfuly");
    }
}