<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => 'required',
            "email" => "required|email",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            'name' => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $token = $user->createToken("mytoken")->plainTextToken;

        return response([
            "data" => $user,
            "token" => $token
        ],201);
    }

    public function logout(){
        // auth()->user()->tokens(auth()->user()->name)->delete();
        Auth::logout();
     

        return response([
            "message" => "logged out",
        ],200);
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email",$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response([
                "message" => "Invalid credentails"
            ],401);
        }
        else{

            $token = $user->createToken($user->name)->plainTextToken;
            return response([
                "message" => "Logged in successfully",
                "token" => $token
            ]);
        }
    }
}
