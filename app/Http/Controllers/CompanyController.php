<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->name;

        $companies = User::where('name', 'like', $name . '%')
            ->where('role', 'company')
            ->get();


        return response()
            ->json([
                'success' => true,
                'data' => $companies
            ], 200);
    }
}
