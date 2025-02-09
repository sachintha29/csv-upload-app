<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CsvUploadController;
use App\Http\Controllers\Api\PdfReportController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/upload-csv', [CsvUploadController::class, 'upload']);
Route::get('/generate-pdf', [PdfReportController::class, 'generateReport']);
