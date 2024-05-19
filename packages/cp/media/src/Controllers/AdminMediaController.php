<?php

namespace Cp\Media\Controllers;


use Cp\Media\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminMediaController extends Controller
{
    public function mediasAll()
    {
        menuSubmenu('media', 'mediasAll');
        $data['medias'] = Media::latest()->paginate(30);
        return view('media::admin.medias.mediasAll', $data);
    }


    public function mediaStore(Request $request)
    {
        menuSubmenu('media', 'mediasAll');
        $validation = Validator::make(
            $request->all(),
            [
                'files' => 'required'
            ]
        );

        if ($validation->fails()) {
            toast('Something Went Wrong!', 'error');
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $ext = strtolower($file->getClientOriginalExtension());
                $mime = $file->getClientMimeType();
                $size = $file->getSize();
                $fileNewName = Str::random(4) . date('ymds') . '.' . $ext;
                list($width, $height) = getimagesize($file);

                Storage::disk('public')->put('media_images/' . $fileNewName, File::get($file));

                $media = new Media;
                $media->file_name = $fileNewName;
                $media->file_mime = $mime;
                $media->file_ext = $ext;
                $media->file_size = $size;
                $media->width = $width;
                $media->height = $height;
                $media->addedby_id = Auth::id();

                if (in_array($ext, Media::SUPPORTED_IMAGE_TYPES)) {
                    $media->file_type = "image";
                } else if (in_array($ext, Media::SUPPORTED_VIDEO_TYPES)) {

                    $media->file_type = "video";
                } else {

                    $media->file_type = "others";
                }
                $media->save();
            }
        }
        toast('Image upload successfully', 'success');
        return back();
    }


    public function mediaDelete(Media $media)
    {
        menuSubmenu('media', 'mediasAll');
        $old = 'media_images/' . $media->file_name;
        if (Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $media->delete();
        toast('Media Iamge successfully deleted', 'success');
        return redirect()->back();
    }


    public function getMediasAjax()
    {
       
        $paginate = 20;
        $medias = Media::latest()->paginate($paginate);
        $html = view('media::admin.medias.mediaAjax', ['medias' => $medias]);
        return response()->json($html->render());
    }
}