<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class UsersController extends Controller{

    public function getUsers(){
        return User::get();
    }

    public function editUser(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $u = User::findOrFail($request->id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->password = bcrypt($request->password);
        $u->save();
    }

    public function editingUser($id){
        $u = User::findOrFail($id);
        return $u;
    }


    public function deleteUser($id){
        $u = User::findOrFail($id);
        $u->delete();
    }

    public function addUser(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>bcrypt(request('password'))
        ]);
        $u = User::all();
        return $u;
    }
}