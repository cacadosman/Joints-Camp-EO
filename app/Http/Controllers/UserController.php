<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function getCurrent(Request $request)
    {
        $response = [
            'success' => true,
            'message' => 'User exist',
            'data' => $request->user()
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Get User by id
     *
     * @param  [integer] id
     * @return [json] user object
     */
    public function getById(Request $request, int $id)
    {
        if ($user = User::where('id', $id)->first()) {
            $response = [
                'success' => true,
                'message' => 'User exist',
                'user' => $user
            ];

            return response()->json($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'User not found',
            'user' => $user
        ];
        return response()->json($response, 404);
    }

    /**
     * Get all Users
     *
     * @return [json] user list object except current user
     */
    public function getAll(Request $request)
    {
        $response = [
            'success' => true,
            'message' => 'Successfully get all users data',
            'users' => $users = User::where('id', '!=', auth()->id())->get()
        ];
        
        return response()->json($response, 200);
    }
}