<?php

namespace App\Http\Controllers;

use App\Models\User;
//use http\Cookie;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function checkRegUser($email){
        $checkuser = User::all()->where('email', '=', $email)->first();
        if ($checkuser){
            return true;
        }else{
            return false;
        }
    }

    public function register(Request $request){
        $check = $this->checkRegUser($request->email);

        if (!$check){
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            return response()->json([
                'user'=>$user
            ], 200);
        }else{
            return response([
                'message'=>'Пользователь с таким email уже существует'
            ], 409);
        }
    }




    public function login(Request $request){

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('Вы ввели неверные данные',400);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }




}
