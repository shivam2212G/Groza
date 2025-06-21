<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
        // ✅ Register API
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->number = $request->number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // $user = User::create([
        //     'name' => $request->name,
        //     'number' => $request->number,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['status' => true, 'message' => 'User registered', 'token' => $token, 'user' => $user]);
    }

    // ✅ Login API
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['status' => true, 'message' => 'Login successful', 'token' => $token, 'user' => $user]);
    }

}
