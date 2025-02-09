<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrdersImport;
use Illuminate\Support\Facades\Storage;


class CsvUploadController extends Controller
{

    // Upload Function
    public function upload(Request $request){

        $request->validate([
            'csv_file' => 'required|file|mimes:csv|max:10248'
        ]);

        try {
            $filePath = $request->file('csv_file')->store('csv_files');
            Excel::import(new OrdersImport, $request->file('csv_file'));

            return response()->json([
                'message' => 'CSV imported successfully!',
                'file_path' => Storage::url($filePath),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Import failed',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
