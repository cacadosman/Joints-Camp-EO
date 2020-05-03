<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] phone
     * @param  [string] address
     * @param  [string] password
     * @return [string] message
     * @return [json] user object
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $password = $request->input('password');
        $role = $request->input('role');

        if (strtolower($role) == 'company')
        {
            $role = 'company';
        }
        else
        {
            $role = 'eo';
        }

        $user = new User([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'password' => bcrypt($password),
            'role' => $role
        ]);

        if ($user->save()) {
            $user->login = [
                'href' => 'api/v1/user/login',
                'method' => 'POST',
                'params' => 'email, password'
            ];

            $response = [
                'success' => true,
                'message' => 'User created',
                'data' => $user
            ];

            return response()->json($response, 201);
        }

        $response = [
            'success' => false,
            'message' => 'An error occured'
        ];

        return response()->json($response, 200);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        if ($user = User::where('email', $email)->first()) {
            $credentials = [
                'email' => $email,
                'password' => $password
            ];

            $token = null;

            if(!Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            $token->save();

            $response = [
                'success' => true,
                'message' => 'Successfully signed in',
                'data' => $user,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ];

            return response()->json($response, 201);
        }

        $response = [
            'success' => false,
            'message' => 'An error occured'
        ];

        return response()->json($response, 200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        $response = [
            'success' => true,
            'message' => 'Successfully logged out'
        ];

        return response()->json($response, 200);
    }
  
}
