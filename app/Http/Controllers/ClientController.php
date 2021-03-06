<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

use App\User;
use Validator;

class ClientController extends Controller
{

    public function index()
    {
        $clients = User::whereRaw('role_id = ?', 5)->orderBy('id', 'desc')->paginate(10);

        if (\Request::ajax()) {
            return \Response::json($clients);
        }

        return view('layouts.client.index', compact('clients'));
    }

    public function show($id)
    {
        $task = User::findOrFail($id);

        return \Response::json($task);
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
            'password' => bcrypt($request->password)
        ]);

        return \Response::json($task);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, User::$updateRules);

        $user = User::findOrFail($id);

        $task = $user->update([
            'c_name' => $request->c_name,
            'm_name' => $request->m_name,
            'm_email' => $request->m_email,
            'c_id' => $request->c_id,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        if (\Request::ajax()) {
            return \Response::json($task);
        }
        $clients = User::whereRaw('role_id = ?', 5)->orderBy('id', 'desc')->paginate(10);
        return view('layouts.client.index', compact('clients'));
    }
}
