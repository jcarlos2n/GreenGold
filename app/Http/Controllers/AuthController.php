<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        try {
            if (!$jwt_token = JWTAuth::attempt($input)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], Response::HTTP_UNAUTHORIZED);
            }
            $userName = auth()->user()->name;
            return response()->json([
                'success' => true,
                'user' => [
                    'name' => $userName,
                
                ],
                'token' => $jwt_token
            ]);
        } catch (\Exception $ex) {
            throw $ex;
        }
        
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUsers(){
        try {
            
            Log::info("Getting users");

            $users = User::query("users")
            ->get()
            ->toArray();

            return response()->json([
                'success' => true,
            'message' => 'Users retrieve succesfully',
            'data' => $users
            ],200);

        } catch(\Exception $exception){

            Log::error("Error getting products: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error getting products. ' . $exception->getMessage(),

            ], 500);
        }
    }
}
