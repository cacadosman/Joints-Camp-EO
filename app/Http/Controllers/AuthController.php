<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @return [string] message
     * @return [json] user object
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        if ($user->save()) {
            $user->signin = [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email, password'
            ];

            $response = [
                'msg' => 'User created',
                'data' => $user
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
    public function signin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
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
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
