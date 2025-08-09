<?php

namespace App\Http\Controllers;

use App\Models\RegisterRepair;
use App\Models\Client;
use App\Models\Device;
use App\Models\Technician;
use Illuminate\Http\Request;

class RegisterRepairController extends Controller
{
    public function index()
    {
        $repairs = RegisterRepair::paginate(10);

        $pendingCount = RegisterRepair::where('repair_status', 'pending')->count();
        $completedCount = RegisterRepair::where('repair_status', 'completed')->count();
        $inProgressCount = RegisterRepair::where('repair_status', 'in progress')->count();

        return view('admin.register_repair', compact(
            'repairs',
            'pendingCount',
            'completedCount',
            'inProgressCount'
        ));
    }

    public function create()
    {
        return view('admin.register_device');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_name' => 'required|string|max:255',
            'device_model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'issue_description' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'date_received' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'diagnosis' => 'nullable|string',
            'repair_actions' => 'nullable|string',
            'repair_status' => 'required|string|max:255',
            'repair_cost' => 'nullable|numeric',
            'technician' => 'nullable|string|max:255',
            'warranty_status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        RegisterRepair::create($validated);

        return redirect()->route('admin.register_repair')->with('success', 'Repair registered successfully.');
    }

    public function show(RegisterRepair $register_repair)
    {
        return view('admin.register_repair_show', compact('register_repair'));
    }

    public function edit(RegisterRepair $register_repair)
    {
        return view('admin.register_repair_edit', compact('register_repair'));
    }

    public function update(Request $request, RegisterRepair $register_repair)
    {
        $validated = $request->validate([
            'device_name' => 'required|string|max:255',
            'device_model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'issue_description' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'date_received' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'diagnosis' => 'nullable|string',
            'repair_actions' => 'nullable|string',
            'repair_status' => 'required|string|max:255',
            'repair_cost' => 'nullable|numeric',
            'technician' => 'nullable|string|max:255',
            'warranty_status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $register_repair->update($validated);

        return redirect()->route('admin.register_repair')->with('success', 'Repair updated successfully.');
    }

    public function destroy(RegisterRepair $register_repair)
    {
        $register_repair->delete();

        return redirect()->route('admin.register_repair')->with('success', 'Repair deleted successfully.');
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'repair_status' => 'required|string|in:pending,completed,in progress',
        ]);

        $repair = RegisterRepair::findOrFail($id);
        $repair->repair_status = $request->repair_status;
        $repair->save();

        return redirect()->back()->with('success', 'Repair status updated successfully.');
    }

    public function showRegisterDevice()
    {
        return view('admin.register_device');
    }

    public function showRegisterViewData()
    {
        $clients = Client::all();
        $devices = Device::all();
        $technicians = Technician::all();

        return view('admin.register_view_data', compact('clients', 'devices', 'technicians'));
    }

    public function registerViewData()
    {
        $repairs = RegisterRepair::with(['client', 'device', 'technician'])->get();
        $clients = Client::all();

        return view('manager.view_data', compact('repairs', 'clients'));
    }
}
