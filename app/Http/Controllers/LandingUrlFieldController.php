<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Landing;
use App\LandingUrlField;

class LandingUrlFieldController extends Controller
{
    public function index(Request $request)
    {
        $task = LandingUrlField::whereRaw('lan_id = ?', $request->lan_id)->get();
        return \Response::json($task);
    }

    public function view($name)
    {
        $name = preg_split('/-/', $name, -1, PREG_SPLIT_NO_EMPTY);

        if ($name[0] == 'olgabebe') {
            return view('layouts.otherLanding.' . $name[0]);
        }

        $url_info = LandingUrlField::whereRaw('lan_url = ?', $name)->get()[0];
        $landing = $url_info->landing;
        $dbTitleArray = [];
        $landing = Landing::findOrFail($landing->id);
        $dbRelFields = $landing->db_rel_fields;
        foreach ($dbRelFields as $item) {
            array_push($dbTitleArray, $item->db_field);
        }

        $jpgArry = [];
        $pngArry = [];

        foreach ($landing->images as $image) {
            $sub1 = preg_split('/_/', $image->image_name, -1, PREG_SPLIT_NO_EMPTY);
            $syb2 = preg_split('/\./', $sub1[count($sub1) - 1], -1, PREG_SPLIT_NO_EMPTY);
            if ($syb2[1] == 'jpg') {
                array_push($jpgArry, $image);
            } else {
                array_push($pngArry, $image);
            }
        }

        /*커스텀 url버튼일 경우*/
        $bottom = 0;
        $url = null;
        foreach ($dbTitleArray as $db_field) {
            if ($db_field->lan_db_types == 'url') {
                $sub1 = preg_split('/_/', $db_field->lan_db_title, -1, PREG_SPLIT_NO_EMPTY);
                $url = $sub1[0];
                $bottom = (int)$sub1[1];
            }
        }
        return view('layouts.landing.show', compact(['url_info', 'landing', 'dbTitleArray', 'jpgArry', 'pngArry', 'bottom','url']));
    }

    public function store(Request $request)
    {
        $task = LandingUrlField::create($request->all());
        return \Response::json($task);
    }

    public function check(Request $request)
    {
        $lan_url = LandingUrlField::whereRaw('lan_url = ?', $request->lan_url)->get()[0];
        return \Response::json($lan_url);
    }

    public function hits($id)
    {
        $luf = LandingUrlField::findOrFail($id);
        $luf->hits += 1;
        $task = $luf->update();
        return \Response::json($task);
    }
}
