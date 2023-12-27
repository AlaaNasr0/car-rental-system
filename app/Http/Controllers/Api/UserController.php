<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function createUser(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'username' => ['required', 'string', 'unique:users'],
                    'email' => ['required', 'unique:users'],
                    'password' => ['required']
                ]
            );
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);
            $token = $user->createToken("API TOKEN")->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'User Created!',
                'token' => $token
            ], 200);
            return redirect()->route('home');
        } catch (Throwable $e) {
            return response()->json(['error' => "Error in Saving Data"], 500);
        }
    }
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'password' => 'required'
                ]
            );
            if ($validateUser->fails()) {
                return response()->json(['error' => $validateUser->errors()]);
            }
            if (!Auth::attempt($request->only(['username', 'password']))) {
                return response()->json(['error' => "Username & pass doesn't match"], 401);
            }
            $user = User::where('username', $request->username)->first();
            $token = $user->createToken("API TOKEN")->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'User Logged in!',
                'token' => $token
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
