<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Landing;
use App\Image;
use App\Http\Requests;
use App\User;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $roleCheck = \Auth::user()->hasRole(['Administrator', 'Manager']);
        $userCheck = \Auth::user()->hasRole(['User']);

        if ($request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));

            if ($userCheck) {
                $landings = Landing::where('client_id', '=', \Auth::user()->id)->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                    ->where('lan_c_name', '=', $request->db_search_text)->orderBy('id', 'desc')->paginate(20);
            } else {
                $landings = Landing::whereBetween('created_at', [$request->db_start_date, $request->db_end_date])
                    ->where('lan_c_name', '=', $request->db_search_text)->orderBy('id', 'desc')->paginate(20);
            }
        } elseif ($request->db_start_date && !$request->db_search_text) {
            Input::merge(array('db_start_date' => $request->db_start_date . ' 00:00:00'));
            Input::merge(array('db_end_date' => $request->db_end_date . ' 23:59:59'));
            if ($userCheck) {
                $landings = Landing::where('client_id', '=', \Auth::user()->id)->whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->orderBy('id', 'desc')->paginate(20);
            } else {
                $landings = Landing::whereBetween('created_at', [$request->db_start_date, $request->db_end_date])->orderBy('id', 'desc')->paginate(20);
            }
        } else {
            if ($userCheck) {
                $landings = Landing::where('client_id', '=', \Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
            } else {
                $landings = Landing::orderBy('id', 'desc')->paginate(20);
            }
        }

        return view('layouts.landing.index', compact('landings', 'roleCheck'));
    }

    public function edit($id, Request $request)
    {
        $landing = Landing::findOrFail($id);

        if ($request->client_value_text) {
            $clients = User::whereRaw('role_id = ?', 5)->where($request->client_column_select, '=', $request->client_value_text)->orderBy('id', 'desc')->paginate(10);
        } else {
            $clients = User::whereRaw('role_id = ?', 5)->orderBy('id', 'desc')->paginate(10);
        }

        if (\Request::ajax()) {
            return \Response::json(view('layouts.landing.partial.client_list', compact('clients'))->render());
        }
        return view('layouts.landing.edit', compact('landing', 'clients'));
    }

    public function update($id)
    {
        $landing = Landing::findOrFail($id);
        $landing->update(Input::all());
        $landing_id = $landing->id;

        return redirect()->route('landing.edit', $landing_id);
    }

    public function create(Request $request)
    {
        if ($request->client_value_text) {
            $clients = User::whereRaw('role_id = ?', 5)->where($request->client_column_select, '=', $request->client_value_text)->orderBy('id', 'desc')->paginate(10);
        } else {
            $clients = User::whereRaw('role_id = ?', 5)->orderBy('id', 'desc')->paginate(10);
        }

        if (\Request::ajax()) {
            return \Response::json(view('layouts.landing.partial.client_list', compact('clients'))->render());
        }
        return view('layouts.landing.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $landing = new Landing();
        $landing->user_id = \Auth::user()->id;
        $landing->client_id = $request->input('client_id');
        $landing->lan_c_name = $request->input('lan_c_name');
        $landing->lan_m_name = $request->input('lan_m_name');
        $landing->lan_start_date = $request->input('lan_start_date');
        $landing->lan_end_date = $request->input('lan_end_date');
        $landing->lan_title = $request->input('lan_title');
        $landing->lan_kakao_id = $request->input('lan_kakao_id');
        $landing->lan_phone = $request->input('lan_phone');
        $landing->lan_page_script = $request->input('lan_page_script');
        $landing->lan_db_script = $request->input('lan_db_script');
        $landing->lan_mobile_confirm = (int)$request->input('lan_mobile_confirm');
        $landing->save();
        $landing_id = $landing->id;

        $files = Input::file('lan_image');
        foreach ($files as $key => $file) {
            $image = \Image::make(Input::file('lan_image')[$key]);
            /*$filename = date('YmdHis') . "_" . $file->getClientOriginalName();*/
            $filename = $file->getClientOriginalName();
            $path = public_path('uploads/images/' . $filename);
            $image->save($path);
            $landing = new Image();
            $landing->image_name = $file->getClientOriginalName();
            $landing->lan_id = $landing_id;
            $landing->save();
        }

        /*$path = public_path() . '/images/';

        foreach ($files as $key =>$file) {
            $image->save($path . $file->getClientOriginalName());
        }*/

        /*$image->resize(150, 150);
        $image->save($path . 'thumb_' . $file->getClientOriginalName());*/

        /**/

        return redirect()->route('landing.edit', $landing_id);
    }
}
