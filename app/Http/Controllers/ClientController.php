<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

use App\User;
use Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = User::whereRaw('role = ?', 'client')->orderBy('id', 'desc')->paginate(5);

        if (\Request::ajax()) {
            return \Response::json(User::whereRaw('role = ?', 'client')->orderBy('id', 'desc')->paginate(5));
        }

        return view('layouts.client.index', compact('clients'));
    }

    public function create()
    {
        return view('layouts.client.create');
    }

    public function store(Request $request)
    {
        $sanitizePhone = $request->all();
        $sanitizePhone['phone'] = formatphonehelper($sanitizePhone['phone']);
        $request->replace($sanitizePhone);
        $this->validate($request, User::$rules);

        /*$sanitizePhone =$request->all();
        $sanitizePhone['phone'] = formatphonehelper($sanitizePhone['phone']);
        $request->replace($sanitizePhone);*/
        /*echo var_dump($request->input('m_email'));*/
        /*User::create($request->all());*/
        /*User::create([
            'c_name' => $request->input('c_name'),
            'm_name' => $request->input('m_name'),
            'm_email' => $request->input('m_email'),
            'c_id' => $request->input('c_id'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);*/

        $task = User::create($request->all());
        return \Response::json($task);
        /*return redirect()->route('client.index');*/
    }
}
