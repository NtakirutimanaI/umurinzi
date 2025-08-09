<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Device;
use App\Models\Technician;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DevicesExport;

class ReportController extends Controller
{
    /**
     * Display the report page with optional date filters.
     */
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Device::with(['client', 'technician']);

        // Apply filters if provided
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $devices = $query->get();
        $clients = Client::all();
        $technicians = Technician::all();

        return view('admin.reports', compact('clients', 'devices', 'technicians', 'startDate', 'endDate'));
    }

    /**
     * Generate and download a PDF report of devices with client & technician.
     */
    public function downloadPDF(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Device::with(['client', 'technician']);

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $devices = $query->get();

        if ($devices->isEmpty()) {
            return redirect()->back()->with('error', 'No devices found for the selected date range.');
        }

        $pdf = Pdf::loadView('admin.reports_pdf', [
            'devices' => $devices,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'generated_on' => now()->format('m/d/Y'),
        ])->setPaper('A4', 'portrait');

        return $pdf->download('devices_report.pdf');
    }

    /**
     * Export the devices report to Excel format using DevicesExport class with date filters.
     */
    public function downloadExcel(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(new DevicesExport($startDate, $endDate), 'devices_report.xlsx');
    }

    /**
     * Export the devices report to Excel using HTML view with .xls extension.
     */
    public function downloadExcelHTML()
    {
        $devices = Device::all();

        $html = view('admin.reports.devices_export', compact('devices'))->render();

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="devices.xls"');
    }

    public function technicians()
{
    $technicians = Technician::all(); // or apply filters if needed
    return view('admin.technicians', compact('technicians'));
}

// In app/Http/Controllers/ReportController.php

public function device()
{
    // For example, fetch devices and return a view
    $devices = \App\Models\Device::all();

    return view('admin.device', compact('devices'));
}


}
