<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest; // استيراد LoginRequest
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    public function login()
    {
       
        $user = User::find(12);
     
      
        $token = $user->createToken('Token appToken')->accessToken;
       
            // التحقق من وجود المستخدم قبل إنشاء الرمز المميز
            if ($user) {
             
    
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 404);
            }
       
    }
    
    
    public function getUserByToken(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.',
            ], 401);
        }

        $accessToken = Token::where('id', $token)->first();

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.',
            ], 401);
        }

        $user = $accessToken->user;

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
    }

