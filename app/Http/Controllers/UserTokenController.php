<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        
        $user = User::where('email', $request->get('email'))->first();
        // dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        
        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'message' => 'Success'
        ], 200);
    }
}
