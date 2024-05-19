<?php

namespace Cp\Slider\Controllers;


use Cp\Media\Models\Media;
use App\Http\Controllers\Controller;
use Cp\Slider\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminSliderController extends Controller
{
    public function slidersAll()
    {
        menuSubmenu('slider', 'slidersAll');
        $data['sliders'] = Slider::latest()->paginate(20);
        return view('slider::admin.sliders.slidersAll', $data);
    }


    public function sliderStore(Request $request)
    {
        dd($request->all());
        menuSubmenu('slider', 'slidersAll');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'featured_image' => 'required|image',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withErrors($validation)
                ->withInput();
        }


        $slider = new Slider;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->link = $request->link ?? null;
        $slider->active = $request->active ? 1 : 0;

        if ($request->hasFile('featured_image')) {

            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = rand(111, 555) . time() . $ext;
            Storage::disk('public')->put('sliders/' . $imageName, File::get($file));
            $slider->featured_image = $imageName;
        }

        $slider->addedBy_id = Auth::id();
        $slider->save();
        toast('Slider added successfully', 'success');
        return back();
    }


    public function sliderEdit(Slider $slider)
    {
        menuSubmenu('slider', 'slidersAll');
        return view('slider::admin.sliders.sliderEdit', compact('slider'));
    }


    public function sliderUpdate(Request $request, Slider $slider)
    {

        menuSubmenu('slider', 'slidersAll');
       
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->link = $request->link ?? null;
        $slider->active = $request->active ? 1 : 0;

        if ($request->hasFile('featured_image')) {
            $old = 'sliders/' . $slider->featured_image;
            if (Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = rand(111, 555) . time() . $ext;
            Storage::disk('public')->put('sliders/' . $imageName, File::get($file));
            $slider->featured_image = $imageName;
        }

        $slider->addedBy_id = Auth::id();
        $slider->save();
        toast('Slider successfully updated', 'success');
        return back();
    }


    public function sliderDelete(Slider $slider)
    {
        menuSubmenu('slider', 'slidersAll');
        $old = 'sliders/' . $slider->featured_image;
        if (Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $slider->delete();
        toast('Slider successfully deleted', 'success');
        return redirect()->back();
    }

    public function sliderSearch(Request $request)
    {
        $type = $request->type;
        $q = $request->q;
        $sliders = Slider::where(function ($qq) use ($q) {
            $qq->orWhere('title', 'like', "%" . $q . "%")
            ->orWhere('id', 'like', "%" . $q . "%");
        })->orderBy('title')
        ->paginate(100);
        $sliders->appends($request->all());
        $page = View('slider::admin.sliders.searchData', ['sliders' => $sliders])->render();
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }

    public function sliderStatus(Request $request){

        $slider = Slider::find($request->slider);
        if(($slider->active == 0)){
          $slider->active =  1;
          $active = true;
        }else{
          $slider->active =  0;
          $active = false;
        }
        $slider->save();
        return response()->json([
            'success' => true,
            'active' => $active
        ]);
    }
}