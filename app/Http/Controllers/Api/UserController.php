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
                    'name' => ['required', 'string'],
                    'email' => ['required', 'unique:users'],
                    'password' => ['required']
                ]
            );
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $user = User::create([
                'name' => $request->input('name'),
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
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
            if ($validateUser->fails()) {
                return response()->json(['error' => $validateUser->errors()]);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(['error' => "Email & pass doesn't match"], 401);
            }
            $user = User::where('email', $request->email)->first();
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
