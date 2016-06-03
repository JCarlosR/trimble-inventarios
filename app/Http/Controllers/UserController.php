<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Ajax requests
        if ($request->ajax()) {
            $search = $request->get('search');
            $users = User::where('name', 'like', $search.'%')->with('role')->paginate(3);
            return $users;
        }

        $users = User::all();
        return view('user.index')->with(compact('users'));
    }

    public function edit($id, Request $request) {
        $user = User::find($id);
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->role_id = $request->get('role')['id'];
        $user->save();

        return $user;
    }

    public function store(Request $request) {
        $user = User::create([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'role_id' => $request->get('role')['id'],
            'password' => bcrypt($request->get('password'))
        ]);

        return $user;
    }

    public function delete() {

    }

}
