<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if( Auth::user()->role_id == 1 )
            return redirect('/');

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
        if( Auth::user()->role_id == 1 )
            return redirect('/');

        $user = User::find($id);
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->role_id = $request->get('role')['id'];
        $user->save();

        return $user;
    }

    public function store(Request $request) {
        if( Auth::user()->role_id == 1 )
            return redirect('/');

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

    public function excel() {
        if( Auth::user()->role_id == 1 )
            return redirect('/');

        Excel::create('Trimble Usuarios', function($excel) {

            $excel->sheet('Usuarios', function($sheet) {
                $users = User::all();
                $sheet->fromArray($users);
            });

        })->export('xls');
    }
}
