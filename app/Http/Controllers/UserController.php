<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    function login(Request $req)
    {
        $user = User::where('email',$req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return \response([
                'error'=>['Email or password is invalid']
            ]);
        }else{
            return $user;
        }
    }
}
