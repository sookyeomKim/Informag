<?php

namespace App\Http\Controllers;

use App\LandingDbField;
use Illuminate\Http\Request;

use App\Http\Requests;

class LandingDbFieldController extends Controller
{
    //

    public function check()
    {

    }

    public function store(Request $request)
    {
        $task = LandingDbField::create($request->all());
        return \Response::json($task);
    }

    public function index(Request $request)
    {
        $task = LandingDbField::whereRaw('lan_id = ?', $request->lan_id)->get();
        return \Response::json($task);
    }

    public function destroy(Request $request)
    {
        $task = LandingDbField::destroy($request->id);
        return \Response::json($task);
    }
}
