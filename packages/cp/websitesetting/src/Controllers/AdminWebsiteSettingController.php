<?php

namespace Cp\WebsiteSetting\Controllers;



use App\Http\Controllers\Controller;
use Cp\WebsiteSetting\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class AdminWebsiteSettingController extends Controller
{
    public function websitesetting()
    {
        menuSubmenu('websitesetting', 'websitesettings');
        $ws = WebsiteSetting::first();
        return view('websitesetting::admin.websitSettings.websiteSettingEdit', compact('ws'));
    }


    public function websiteSettingUpdate(Request $request, WebsiteSetting $ws)
    {

        // dd($request->all());
        $ws->website_title = $request->website_title;
        $ws->google_search_console = $request->google_search_console;
        $ws->google_analytics_code = $request->google_analytics_code;
        $ws->facebook_pixel_code = $request->facebook_pixel_code;
        $ws->meta_author = $request->meta_author;
        $ws->meta_description = $request->meta_description;
        $ws->footer_copyright = $request->footer_copyright;
        $ws->contact_mobile = $request->contact_mobile;
        $ws->contact_email = $request->contact_email;
        $ws->contact_address = $request->contact_address;

        $ws->fb_url = $request->fb_url;
        $ws->twitter_url = $request->twitter_url;
        $ws->youtube_url = $request->youtube_url;
        $ws->linkedin_url = $request->linkedin_url;

        $ws->footer_bottom_bg_color = $request->footer_bottom_bg_color;
        $ws->footer_bottom_text_color = $request->footer_bottom_text_color;
        $ws->footer_contact = $request->footer_contact;
        $ws->footer_address = $request->footer_address;

        $ws->editedby_id = Auth::id();


        if ($request->hasFile('logo')) {
            $old_file = 'ws/' . $ws->logo;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->logo;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "logo" . time() . $ext;
            Storage::disk('public')->put('ws/' . $imageName, File::get($file));
            $ws->logo = $imageName;
        }



        if ($request->hasFile('logo_alt')) {
            $old_file = 'ws/' . $ws->logo_alt;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->logo_alt;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "logo_alt" . time() . $ext;
            Storage::disk('public')->put('ws/' . $imageName, File::get($file));
            $ws->logo_alt = $imageName;
        }


        if ($request->hasFile('favicon')) {
            $old_file = 'ws/' . $ws->favicon;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->favicon;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "favicon" . time() . $ext;
            Storage::disk('public')->put('ws/' . $imageName, File::get($file));
            $ws->favicon = $imageName;
        }
 
        if ($request->hasFile('footer_image')) {
            $old_file = 'footer_image/' . $ws->footer_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->footer_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = "footer_image" . time() . $ext;
            Storage::disk('public')->put('footer_image/' . $imageName, File::get($file));
            $ws->footer_image = $imageName;
        }


        $ws->save();
        cache()->flush();
        toast('Websetting setting successfully updated', 'success');
        return redirect()->back();
    }
}