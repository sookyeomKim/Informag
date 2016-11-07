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
        $url_info = LandingUrlField::whereRaw('lan_url = ?', $name)->get()[0];
        $landing = $url_info->landing;

        return view('layouts.landing.show', compact(['url_info', 'landing']));
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
