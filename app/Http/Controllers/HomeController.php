<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the client dashboard.
     *
     * @return \Illuminate\View\View
     */
   
    public function adminDashboard()
    {
        return view('admin.index');
    }
    public function managerDashboard()
    {
        return view('manager.index');
    }

    public function supervisorDashboard()
    {
        return view('supervisor.index');
    }

    public function businessDashboard()
    {
        return view('business.index');
    }

    public function technicianDashboard()
    {
        return view('technician.index');
    }

    public function mechanicDashboard()
    {
        return view('mechanic.index');
    }

    public function tailorDashboard()
    {
        return view('tailor.index');
    }

    public function craftspersonDashboard()
    {
        return view('craftsperson.index');
    }

    public function mediatorDashboard()
    {
        return view('mediator.index');
    }  
    public function clientDashboard()
    {
        return view('client.index');
    }  
}
