<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
     public function index()
    {
        $devices = Device::all();
        return view('admin.device', compact('devices'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'brand'                 => 'required|string|max:255',
            'model'                 => 'required|string|max:255',
            'serial_number'         => 'required|string|max:255',
            'imei_1'                => 'nullable|string|max:255',
            'imei_2'                => 'nullable|string|max:255',
            'imei_3_or_mac_or_plate'=> 'nullable|string|max:255',
            'type'                  => 'nullable|string|max:255',
            'os'                    => 'nullable|string|max:255',
            'status'                => 'nullable|in:active,inactive,under_repair,lost,stolen,repair_approved',
            'purchase_date'         => 'nullable|date',
            'warranty_expiry'       => 'nullable|date',
            'location'              => 'nullable|string|max:255',
            'notes'                 => 'nullable|string',
            'client_id'             => 'nullable|exists:clients,id',
        ]);

        $device = Device::create($request->only([
            'brand', 'model', 'serial_number', 'imei_1', 'imei_2', 'imei_3_or_mac_or_plate',
            'type', 'os', 'status', 'purchase_date', 'warranty_expiry', 'location', 'notes', 'client_id'
        ]));

        return response()->json(['success' => true, 'device_id' => $device->id]);
    }
}
