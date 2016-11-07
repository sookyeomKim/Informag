<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Landing;
use App\DbManageField;

class DbManageFieldController extends Controller
{
    public function store(Request $request)
    {
        $task = DbManageField::create($request->all());
        return \Response::json($task);
    }

    public function show($id)
    {
        $lan_info = Landing::findOrFail($id);
        $dmf_info = $lan_info->db_manage_fields;
        $url_info = $lan_info->url_fields;
        $db_list = $lan_info->db_manage_fields()->paginate(5);//https://www.youtube.com/watch?v=e32dApb5yYI
        $db_info = $lan_info->db_fields;
        return view('layouts.landing.db_show', compact('dmf_info', 'lan_info', 'url_info', 'db_list', 'db_info'));
    }
}
