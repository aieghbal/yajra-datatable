<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $users = 'Ali';
        //return view('index',compact('users'));


        return view('register');
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();
        return redirect('/dashboard');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('edit',compact('user'));
    }

    public function postEdit(Request $request)
    {
        $user = User::find($request->userId);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('dashboard');
    }
}
