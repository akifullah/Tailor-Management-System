<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => "email|required",
            "password" => "required|min:5",
        ]);


        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Login Failed.",
                "error" => $validator->errors(),
            ], 400);
        }

        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $request->session()->regenerate();
            
            // Get the user and determine redirect URL based on permissions
            $user = Auth::user();
            $redirectUrl = getFirstAccessibleRoute($user);
            
            return response()->json([
                "success" => true,
                "message" => "Login Successfully.",
                "redirect_url" => $redirectUrl,
            ], 200);
        }



        return response()->json([
            "success" => false,
            "message" => "Invalid credetials.",
            "error" => $validator->errors()
        ], 400);
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    
}
