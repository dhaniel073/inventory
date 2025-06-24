<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;


class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        //validate data
        $rules = ([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors()->toArray(),422);
        }
        
        //reqister an admin/staff
        User::create([
            'name' => strip_tags($request->input('name')),
            'email' => $request->input('email'),
            'role' => strip_tags($request->input('role') ?? 'staff'),
            'password' => Hash::make($request->input('password')),
        ]);

        //return response
        return response()->json(['message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        //required parameters
        $rules = ([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //validator
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors()->toArray(),422);
        }

        //select required data for login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        //create bearer authentication token
        $token = Auth::user()->createToken('API Token')->plainTextToken;

        //return response
        return response()->json(['token' => $token]);
    }

    public function userInfo(Request $request)
    {
        // get user details
        return response()->json($request->user());
    }

    public function logOut(Request $request)
    {
        // destroy token and log out user
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
