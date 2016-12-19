<?php

namespace App\Http\Controllers;

use App\LandingDbField;
use App\DbRelField;
use App\Landing;
use Illuminate\Http\Request;

use App\Http\Requests;

class LandingDbFieldController extends Controller
{
    public function store(Request $request)
    {
        $task = null;
        $checkTitle = LandingDbField::where('lan_db_title', '=', $request->lan_db_title)->get();
        if (count($checkTitle) == 0) {
            LandingDbField::create([
                'lan_db_title' => $request->lan_db_title,
                'lan_db_types' => $request->lan_db_types
            ]);
            $task = DbRelField::create([
                'lan_id' => $request->lan_id,
                'db_id' => LandingDbField::where('lan_db_title', '=', $request->lan_db_title)->get()[0]->id]);
        } else {
            $checkDbId = DbRelField::where('lan_id', '=', $request->lan_id)->where('db_id', '=', LandingDbField::where('lan_db_title', '=', $request->lan_db_title)->get()[0]->id)->get();
            if (count($checkDbId) == 0) {
                $task = DbRelField::create([
                    'lan_id' => $request->lan_id,
                    'db_id' => LandingDbField::where('lan_db_title', '=', $request->lan_db_title)->get()[0]->id]);
            } else {
                $task = "이미 등록된 DB명입니다.";
            }
        }
        return \Response::json($task);
    }

    public function index(Request $request)
    {
        $rstArray = [];
        $landing = Landing::findOrFail($request->lan_id);
        $dbRelFields = $landing->db_rel_fields;
        foreach ($dbRelFields as $item) {
            array_push($rstArray, $item->db_field);
        }
        return \Response::json($rstArray);
    }

    public function destroy(Request $request)
    {
        $task = LandingDbField::destroy($request->id);
        return \Response::json($task);
    }
}
