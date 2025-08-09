<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technician;
use App\Models\Device;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::all();
        return view('admin.technicians', compact('technicians'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'nullable|email|max:255',
            'phone'            => 'nullable|string|max:255',
            'expertise'        => 'required|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'certifications'   => 'nullable|string|max:255',
            'status'           => 'nullable|in:active,inactive,on_leave',
            'location'         => 'nullable|string|max:255',
            'notes'            => 'nullable|string',
            'registered_on'    => 'nullable|date',
            'received_by'      => 'nullable|string|max:255',
            'position'         => 'nullable|string|max:255',
            'device_id'        => 'nullable|exists:devices,id',
        ]);

        $technician = Technician::create($request->only([
            'name', 'email', 'phone', 'expertise', 'experience_years', 'certifications',
            'status', 'location', 'notes', 'registered_on', 'received_by', 'position'
        ]));

        if ($request->filled('device_id')) {
            $device = Device::find($request->input('device_id'));
            if ($device) {
                $device->assigned_technician_id = $technician->id;
                $device->save();
            }
        }

        return response()->json(['success' => true, 'technician_id' => $technician->id]);
    }
        public function dashboard()
    {
        return view('technician.index'); // Make sure this view exists
    }

    public function show($id)
{
    $technician = Technician::findOrFail($id);
    return view('admin.technician', compact('technician'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'expertise' => 'required|string|max:255',
        'experience_years' => 'nullable|integer',
        'certifications' => 'nullable|string|max:255',
        'status' => 'nullable|in:active,inactive,on_leave',
        'location' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'registered_on' => 'nullable|date',
        'received_by' => 'nullable|string|max:255',
        'position' => 'nullable|string|max:255',
    ]);

    $technician = Technician::findOrFail($id);
    $technician->update($request->all());

    return redirect()->route('admin.technicians')->with('success', 'Technician updated successfully.');
}

 public function registerRepair()
    {
        
        return view('technician.register_repair');
    }
    public function registerViewData()
{
    return view('technician.register_view_data');
}
public function device()
{   
    return view('technician.device'); // or whatever view you want
}
public function technicians()
{
    // load your data and return view
    $technicians = Technician::all();
    return view('technician.index', compact('technicians'));
}
public function registerDevice()
{
    return view('technician.register_device');
}



}
