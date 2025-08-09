<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use Illuminate\Support\Facades\Storage;

class RepairController extends Controller
{
    /**
     * Display a listing of repairs.
     */
    public function index()
    {
        $repairs = Repair::paginate(10);
        return view('admin.repair_device', compact('repairs'));
    }

    /**
     * Show the form for creating a new repair.
     */
    public function create()
    {
        return view('admin.repair_device');
    }

    /**
     * Store a newly created repair in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_type' => 'required|string|max:255',
            'device_name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:repairs,serial_number',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'operating_system' => 'nullable|string|max:255',
            'device_owner' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'received_date' => 'required|date',
            'warranty_status' => 'required|in:Under Warranty,Out of Warranty',
            'problem_description' => 'required|string',
            'technician' => 'nullable|string|max:255',
            'estimated_cost' => 'nullable|numeric',
            'repair_status' => 'nullable|in:Pending,In Progress,Completed',
            'repair_report_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('repair_report_file')) {
            $file = $request->file('repair_report_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('repairs', $filename, 'public');
            $validated['repair_report_file'] = $filename;
        }

        // Default repair status if not provided
        if (empty($validated['repair_status'])) {
            $validated['repair_status'] = 'Pending';
        }

        Repair::create($validated);

        return redirect()->route('repairs.create')->with('success', 'Repair info submitted successfully!');
    }
}
