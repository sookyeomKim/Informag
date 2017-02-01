<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Landing;
use App\DbManageField;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\WebDataTempMkt;

class DbManageFieldController extends Controller
{
    public function store(Request $request)
    {
        /*코마스 중복 검사*/
        /*TODO 후에 공용으로 수정하기*/
        $getDbs = DbManageField::where('lan_id', '=', $request->lan_id)->where('db_content->이름', '=', $request->db_content['이름'])->where('db_content->연락처', '=', $request->db_content['연락처'])->get();
        $checkArry = count($getDbs) == 0;
        if ($checkArry) {
            $requestVal = $request->all();
            if ($requestVal['lan_id'] == 4) {
                $comas = new WebDataTempMkt();
                $comas->MKT_Code = '1005';
                $comas->MKT_Date = '';
                $comas->Tel_No = $requestVal['db_content']['연락처'];
                $comas->Tel_Name = $requestVal['db_content']['이름'];
                $comas->Tel_Type = '';
                $comas->Tel_Etc1 = $requestVal['db_content']['상담내용'];
                $comas->Tel_Etc2 = '';
                $comas->Tel_Etc3 = '';
                $comas->Tel_Etc4 = '';
                $comas->Tel_Etc5 = '';
                $comas->Insert_Date = date('Y-m-d H:i:s', time());
                $comas->save();
            }
            $task = DbManageField::create($request->all());
            /*return \Response::json($task);*/
            /*return \Response::json($requestVal['db_content']['이름']);*/
            return \Response::json(true);
        } else {
            return \Response::json($checkArry);
        }
    }

    public function show($id, Request $request)
    {
        $roleCheck = \Auth::user()->hasRole(['Administrator']);

        $lan_info = Landing::findOrFail($id);
        $dmf_info = $lan_info->db_manage_fields;
        $url_info = $lan_info->url_fields;

        if ($request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                ->where('db_content->' . $request->db_title_select, '=', $request->db_search_text)->orderBy('id', 'desc')->paginate(20);

        } elseif ($request->db_start_date && !$request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->orderBy('id', 'desc')->paginate(20);

        } else {
            $db_list = $lan_info->db_manage_fields()->orderBy('id', 'desc')->paginate(20);

        }

        $dbArray = [];
        $dbRelFields = $lan_info->db_rel_fields;
        foreach ($dbRelFields as $item) {
            array_push($dbArray, $item->db_field);
        }
        $db_info = $dbArray;
        return view('layouts.landing.db_show', compact('dmf_info', 'lan_info', 'url_info', 'db_list', 'db_info', 'roleCheck'));
    }

    public function excelExport($id, Request $request)
    {
        $lan_info = Landing::findOrFail($id);

        if ($request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                ->where('db_content->' . $request->db_title_select, '=', $request->db_search_text)->orderBy('id', 'desc')->get();
        } elseif ($request->db_start_date && !$request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));
            $db_list = $lan_info->db_manage_fields()->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->orderBy('id', 'desc')->get();
        } else {
            $db_list = $lan_info->db_manage_fields()->orderBy('id', 'desc')->get();
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
                $sheet->setWidth(array(
                    'A' => 20,
                    'B' => 20,
                    'C' => 20
                ));
                $sheet->fromArray($resArray);
            });
        })->export('xls');
    }
}