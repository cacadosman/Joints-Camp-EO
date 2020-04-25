<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'password' => 'required|string|min:5'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $password = $request->input('password');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'password' => bcrypt($password)
        ]);

        if ($user->save()) {
            $user->login = [
                'href' => 'api/v1/user/login',
                'method' => 'POST',
                'params' => 'email, password'
            ];

            $response = [
                'msg' => 'User created',
                'user' => $user
            ];

            return response()->json($response, 201);
        }

        $response = [
            'msg' => 'An error occured'
        ];

        return response()->json($response, 404);
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
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:5'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if ($user = User::where('email', $email)->first()) {
            $credentials = [
                'email' => $email,
                'password' => $password
            ];

            $token = null;

            if(!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            $token->save();

            $response = [
                'msg' => 'Successfully signed in',
                'user' => $user,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ];

            return response()->json($response, 201);
        }

        $response = [
            'msg' => 'An error occured'
        ];

        return response()->json($response, 404);

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
            'msg' => 'Successfully logged out'
        ];

        return response()->json($response, 200);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function userCurrent(Request $request)
    {
        $response = [
            'msg' => 'User exist',
            'user' => $request->user()
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Get User by id
     *
     * @param  [integer] id
     * @return [json] user object
     */
    public function userById(Request $request, int $id)
    {
        if ($user = User::where('id', $id)->first()) {
            $response = [
                'msg' => 'User exist',
                'user' => $user
            ];

            return response()->json($response, 200);
        }

        $response = [
            'msg' => 'User not found',
            'user' => $user
        ];
        return response()->json($response, 404);
    }

    /**
     * Get all Users
     *
     * @return [json] user list object except current user
     */
    public function usersAll(Request $request)
    {
        $response = [
            'msg' => 'Successfully get all users data',
            'users' => $users = User::where('id', '!=', auth()->id())->get()
        ];
        
        return response()->json($response, 200);
    }
}
