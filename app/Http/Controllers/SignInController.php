<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SignInController extends Controller{

    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $crediential=$request->only('email','password');

        if(!$token=JWTAuth::attempt($crediential)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        return response()->json(compact('token'));
    }

    public function logout(){
        return 'Logged Out';
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}