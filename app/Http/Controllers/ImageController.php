<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Image;
use App\Http\Requests;
use League\Flysystem\File;

class ImageController extends Controller
{
    public function destroy(Request $request)
    {
        $path = public_path() . '/uploads/images/';
        \File::delete($path . $request->image_name);
        $take = Image::destroy($request->image_id);
        return \Response::json($take);
    }

    public function store(Request $request)
    {
        $files = Input::file('lan_image');
        foreach ($files as $key => $file) {
            $image = \Image::make(Input::file('lan_image')[$key]);
            $path = public_path() . '/uploads/images/';
            $image->save($path . $file->getClientOriginalName());
            $landing = new Image();
            $landing->image_name = $file->getClientOriginalName();
            $landing->lan_id = $request->lan_id;
            $take = $landing->save();
        }
        return \Response::json($take);
    }
}
