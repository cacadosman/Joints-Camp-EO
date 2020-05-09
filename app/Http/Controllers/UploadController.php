<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        $category = $request->input('category');
        $description = $request->input('description');
        $event_date = $request->input('event_date');
        $file = $request->file('file');

        if ($file) {
            $fileName = str_replace(' ', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/images');

            $proposal = new Proposal([
                'directory' => $fileName,
                'category' => $category,
                'description' => $description,
                'event_date' => $event_date
            ]);

            if ($proposal->save()) {
                $proposal->users()->attach([$user->id]);
                $file->move($destinationPath, $fileName);

                $response = [
                    'success' => true,
                    'message' => 'File uploaded',
                    'data' => $proposal
                ];
    
                return response()->json($response, 201);
            }

            $response = [
                'success' => false,
                'message' => 'Upload failed'
            ];
    
            return response()->json($response, 200);
        }

        $response = [
            'success' => false,
            'message' => 'Upload failed'
        ];

        return response()->json($response, 200);
    }
}
