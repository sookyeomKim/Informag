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

    public function show($id, Request $request)
    {
        $lan_info = Landing::findOrFail($id);
        $dmf_info = $lan_info->db_manage_fields;
        $url_info = $lan_info->url_fields;
        if ($request->db_search_text) {
            /*$db_list = $lan_info->db_manage_fields()->where('db_content->name', $request->db_search_text)->paginate(5);*/
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                ->where('db_content->' . $request->db_title_select, '=', $request->db_search_text)->paginate(5);
        } elseif ($request->db_start_date && !$request->db_search_text) {
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->paginate(5);
        } else {
            $db_list = $lan_info->db_manage_fields()->paginate(5);
        }
        /*$db_list = $lan_info->db_manage_fields;*/

        $db_info = $lan_info->db_fields;
        $test = $request;
        return view('layouts.landing.db_show', compact('dmf_info', 'lan_info', 'url_info', 'db_list', 'db_info', 'test'));
    }
}
