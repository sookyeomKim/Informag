<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LandingTermsField;

class LandingClauseFieldController extends Controller
{
    public function index($lan_id)
    {
        $task = LandingTermsField::whereRaw('lan_id = ?', $lan_id)->get();
        return \Response::json($task);
    }

    public function store(Request $request)
    {
        $task = LandingTermsField::create($request->all());
        return \Response::json($task);
    }

    public function destroy(Request $request)
    {
        $task = LandingTermsField::destroy($request->id);
        return \Response::json($task);
    }
}
