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
        $user = User::where('email', $request->email)->first();
        if ($user){
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user->first());
                return $user;
            }else{
                return response('Verifique la contraseña', 401);
            }
        }else{
            return response('Las credenciales ingresadas no son correctas', 401);
        }
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
