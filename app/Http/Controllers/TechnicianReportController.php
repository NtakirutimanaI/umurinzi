<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnicianReportController extends Controller
{
    public function storeRepair(Request $request)
{
    // validate and store

    return redirect()->route('technician.register_repair')
        ->with('success', 'Repair registered successfully.');
}

}
