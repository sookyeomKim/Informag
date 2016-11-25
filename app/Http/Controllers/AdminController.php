<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereRaw('role_id = ?', 3)->orderBy('id', 'desc')->paginate(10);

        if (\Request::ajax()) {
            return \Response::json($admins);
        }

        return view('layouts.admin.index', compact('admins'));
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
            'role_id' => 3,
            'password' => bcrypt($request->password)
        ]);

        return \Response::json($task);
    }
}
