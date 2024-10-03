<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $validation = $request->validated();
        $validation['password'] = bcrypt($request->password);
        $user = User::create($validation);
        
        return response()->json(['success'=>true , 'data'=>$user]);
    }
    
    public function login(UserRequest $request)
    {
        if(!Auth::attempt($request->only(['ID_no' , 'password'])))
        {
            return response()->json(['message'=>'Unauthorized' , 'code'=>401]);
        }

        $user= User::where('ID_no' , $request->ID_no)->first();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = ['user'=>$user , 'token'=>$token , 'code'=>200];
        
        return response()->json(['success'=>true , 'data'=>$response]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        
        return response()->json(['message'=>'Logged out successfully']);
    }
}
