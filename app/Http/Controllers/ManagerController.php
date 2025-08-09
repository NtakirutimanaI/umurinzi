<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Technician;
use App\Models\RegisterRepair;

class ManagerController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }

    public function registerRepair()
    {
        return view('manager.register_repair');
    }

    public function registerViewData()
    {
        // Example: fetch all register repairs with relations
        $repairs = RegisterRepair::with(['client', 'device', 'technician'])->get();

        return view('manager.view_data', compact('repairs'));
    }

    public function device()
    {
        // Example: fetch all devices
        $devices = Device::all();

        return view('manager.device', compact('devices'));
    }

    public function technicians()
    {
        // Example: fetch all technicians
        $technicians = Technician::all();

        return view('manager.technicians', compact('technicians'));
    }
}
