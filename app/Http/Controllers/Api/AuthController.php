<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $message='';
            $no = 1;
            foreach ($errors->all() as $key) {
                $message.=$no++.'.'.$key.' ';
            }
            return response()->json([
                'status'=>false,
                'code'  =>400,
                'message'=>$message,
            ], 400);
        }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status'=>true,
                    'code'  =>200,
                    'message' => 'success login',
                    'data'    => Auth::user(),
                ], 200);
            } else {
                return response()->json([
                    'status'=>false,
                    'code'  =>401,
                    'message' => 'failed, please check email or phone and password'
                ], 401);
            }
    }
}
