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

    public function register(Request $request)
    {
        $this->validate($request, User::$rules);

        $task = User::create([
            'c_name' => $request->c_name,
            'm_name' => $request->m_name,
            'm_email' => $request->m_email,
            'c_id' => $request->c_id,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 1
        ]);

        return \Response::json($task);
    }
}
