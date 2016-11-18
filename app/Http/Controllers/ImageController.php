<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Image;
use App\Http\Requests;

class ImageController extends Controller
{
    public function destroy(Request $request)
    {
        $filenmae = $request->image_name;
        $path = public_path() . 'uploads/images/' . $filenmae;
        \File::delete($path);
        $take = Image::destroy($request->image_id);
        return \Response::json($take);
    }

    public function store(Request $request)
    {
        $files = Input::file('lan_image');
        foreach ($files as $key => $file) {
            $image = \Image::make(Input::file('lan_image')[$key]);
            /*$filename = date('YmdHis') . "_" . $file->getClientOriginalName();*/
            $filename = $file->getClientOriginalName();
            $path = public_path('uploads/images/' . $filename);
            $image->save($path);
            $landing = new Image();
            $landing->image_name = $file->getClientOriginalName();
            $landing->lan_id = $request->lan_id;
            $take = $landing->save();
        }
        return \Response::json($take);
    }
}
