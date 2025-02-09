<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfReportController extends Controller
{
    // generate report function
    public function generateReport(){

        try{

        $orders = Order::with('customer', 'items')->get();

        if ($orders->isEmpty()) {
            return response()->json(['error' => 'No orders found'], 404);
        }

        $pdf = Pdf::loadView('pdf.report', compact('orders'))->setPaper('a4', 'landscape');

        Storage::makeDirectory('public/reports');

        $fileName = 'reports/orders_' . now()->timestamp . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        return response()->json([
            'message' => 'PDF Report generated successfully!',
            'pdf_link' => asset('storage/' . $fileName)
        ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }
}
