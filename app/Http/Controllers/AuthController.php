<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function init(){
        return Auth::user();
    }

    public function login(LoginUser $request){
        $user = User::where([
            ['email', $request->email],
            ['password' , Hash::check('plain-text', $request->password)]
        ])->get();
        if (count($user)==0)
            return response('Las credenciales ingresadas no son correctas', 401);
        Auth::login($user->first());
        return $user;
    }

    public function logout()
    {
        Auth::logout();
        return null;
    }

    public function store(StoreUser $request)
    {

    }
}
