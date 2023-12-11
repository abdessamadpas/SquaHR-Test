<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registration(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 202);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $res = [
            'token' => $user->createToken('api-application')->accessToken,
            'name' => $user->name,
            'email' => $user->email
        ];
        return response()->json($res, 200);
    }


    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
    
        if(Auth::attempt($credentials)) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $res = [
                'token' => $user->createToken('api-application')->accessToken,
                'name' => $user->name,
                'email' => $user->email
            ];
            return response()->json($res, 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
