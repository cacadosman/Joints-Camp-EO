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

    public function get($id)
    {
        $company = User::find($id);
        if ($company == null || $company->role == 'eo')
        {
            return response()
                ->json([
                    'success' => false,
                    'message' => 'Company tidak ditemukan'
                ], 200);
        }

        return response()
            ->json([
                'success' => true,
                'data' => $company
            ], 200);
    }
}
