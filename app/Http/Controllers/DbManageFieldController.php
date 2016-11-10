<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Landing;
use App\DbManageField;
use Maatwebsite\Excel\Facades\Excel;

class DbManageFieldController extends Controller
{
    public function store(Request $request)
    {
        $task = DbManageField::create($request->all());
        return \Response::json($task);
    }

    public function show($id, Request $request)
    {
        $roleCheck = \Auth::user()->hasRole(['Administrator']);

        $lan_info = Landing::findOrFail($id);
        $dmf_info = $lan_info->db_manage_fields;
        $url_info = $lan_info->url_fields;
        if ($request->db_search_text) {
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                ->where('db_content->' . $request->db_title_select, '=', $request->db_search_text)->paginate(5);
        } elseif ($request->db_start_date && !$request->db_search_text) {
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->paginate(5);
        } else {
            $db_list = $lan_info->db_manage_fields()->paginate(5);
        }

        $db_info = $lan_info->db_fields;
        return view('layouts.landing.db_show', compact('dmf_info', 'lan_info', 'url_info', 'db_list', 'db_info', 'roleCheck'));
    }

    public function excelExport($id, Request $request)
    {
        $lan_info = Landing::findOrFail($id);
        if ($request->db_search_text) {
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                ->where('db_content->' . $request->db_title_select, '=', $request->db_search_text)->get();
        } elseif ($request->db_start_date && !$request->db_search_text) {
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->get();
        } else {
            $db_list = $lan_info->db_manage_fields()->get();
        }

        //http://stackoverflow.com/questions/15167439/associative-array-change-position
        $resArray = array();
        foreach ($db_list as $value) {
            $created_at = $value->created_at->format('Y-m-d H:i:s');
            $db_inflow = $value->db_inflow;
            $arry = array('No.' => $value->id, '생성일' => $created_at, '유입경로' => $db_inflow);
            foreach ($value->db_content as $key => $value) {
                $arry[$key] = $value;
            }
            array_push($resArray, $arry);
        }
        Excel::create('Export Data', function ($excel) use ($resArray) {
            $excel->sheet('Sheet 1', function ($sheet) use ($resArray) {
                $sheet->fromArray($resArray);
            });
        })->export('xls');
    }
}
