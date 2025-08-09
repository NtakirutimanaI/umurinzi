<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\CraftsPersonController;
use App\Http\Controllers\MediatorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegisterRepairController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\Auth\RegisteredUser2Controller;
use App\Http\Controllers\BusinessPersonController;
use App\Http\Controllers\ActivityReportController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('web.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//Google
Route::get('/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index'); // or your admin dashboard view
    })->name('dashboard');
});

// -- Dashboard routes protected by respective role middleware -- //

Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client/dashboard', [HomeController::class, 'clientDashboard'])->name('client.dashboard');
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::get('/manager/index', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('manager/register_repair', [ManagerController::class, 'registerRepair'])->name('manager.register_repair');
});
Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/view-data', [RegisterRepairController::class, 'registerViewData'])->name('manager.register_view_data');
});
Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/device', [ReportController::class, 'device'])->name('manager.device');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/technicians', [ReportController::class, 'technicians'])->name('manager.technicians');
});
Route::middleware(['auth', 'technician'])->group(function () {
    Route::get('/technician/reports', [TechnicianReportController::class, 'index'])->name('technician.reports');
});


Route::middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/supervisor/dashboard', [HomeController::class, 'supervisorDashboard'])->name('supervisor.dashboard');
});
Route::prefix('supervisor')->name('supervisor.')->middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/', [SupervisorController::class, 'index'])->name('index'); 
});


Route::middleware(['auth', 'businessperson'])->group(function () {
    Route::get('/business/dashboard', [HomeController::class, 'businessDashboard'])->name('business.dashboard');
    Route::get('/businessperson', [BusinessPersonController::class, 'index'])->name('businessperson.index');
    Route::prefix('businessperson')->name('businessperson.')->group(function () {
        Route::get('/dashboard', [BusinessController::class, 'dashboard'])->name('dashboard');
    });
});


Route::middleware(['auth', 'technician'])->group(function () {
    Route::get('/technician/dashboard', [HomeController::class, 'technicianDashboard'])->name('technician.dashboard');
    Route::prefix('technician')->name('technician.')->group(function () {
        Route::get('/', [TechnicianController::class, 'index'])->name('index');
        Route::get('/dashboard', [TechnicianController::class, 'dashboard'])->name('dashboard');
    });
});
Route::middleware(['auth', 'technician'])->prefix('technician')->group(function () {
    Route::get('/register_repair', [TechnicianController::class, 'registerRepair'])->name('technician.register_repair');
    Route::get('/dashboard', [TechnicianController::class, 'index'])->name('technician.index');
    // other technician routes
});
Route::get('/technician/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');



Route::middleware(['auth', 'mechanic'])->group(function () {
    Route::get('/mechanic/dashboard', [HomeController::class, 'mechanicDashboard'])->name('mechanic.dashboard');
    Route::prefix('mechanic')->name('mechanic.')->group(function () {
        Route::get('/', [MechanicController::class, 'index'])->name('index');
    });
});

Route::middleware(['auth', 'tailor'])->group(function () {
    Route::prefix('tailor')->name('tailor.')->group(function () {
        Route::get('/', [TailorController::class, 'index'])->name('index');
    });
});
Route::middleware(['auth', 'tailor'])->prefix('tailor')->name('tailor.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TailorController::class, 'dashboard'])->name('dashboard');
});

//
Route::middleware(['auth', 'craftsperson'])->prefix('craftsperson')->group(function () {
    Route::get('/', [CraftsPersonController::class, 'index'])->name('craftsperson.index');
    Route::get('/dashboard', [CraftsPersonController::class, 'dashboard'])->name('craftsperson.dashboard');
});


Route::middleware(['auth', 'mediator'])->group(function () {
    Route::get('/mediator', [MediatorController::class, 'index'])->name('mediator.index');
});
Route::middleware(['auth', 'mediator'])->prefix('mediator')->name('mediator.')->group(function () {
    Route::get('/dashboard', [MediatorController::class, 'dashboard'])->name('dashboard');
});


// -- Register and Login Routes (no change) -- //

Route::get('/register', [RegisteredUserController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// -- Admin routes protected by admin middleware -- //

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::put('users/{user}/role', [UserController::class, 'changeRole'])->name('users.changeRole');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    Route::resource('register_repair', RegisterRepairController::class);

    Route::patch('register_repair/{registerRepair}/change-status', [RegisterRepairController::class, 'changeStatus'])->name('register_repair.changeStatus');

    Route::resource('repairs', RegisterRepairController::class)->names([
        'index' => 'repairs.index',
        'create' => 'repairs.create',
        'store' => 'repairs.store',
        'show' => 'repairs.show',
        'edit' => 'repairs.edit',
        'update' => 'repairs.update',
        'destroy' => 'repairs.destroy',
    ]);

    // Register device routes
    Route::get('register-device', [RegisterRepairController::class, 'create'])->name('register_device.create');
    Route::post('register-device', [RegisterRepairController::class, 'store'])->name('register_device.store');
    Route::get('register_view_data', [RegisterRepairController::class, 'showRegisterViewData'])->name('register_view_data');
});


Route::get('/users', [UserController::class, 'user'])
    ->name('users')->middleware(['auth', 'admin']);


Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::put('/users/{user}/role', [UserController::class, 'changeRole'])->name('users.role');
});


// -- Profile routes protected by auth only -- //

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// -- Repair routes protected by auth -- //

Route::middleware(['auth'])->group(function () {
    Route::get('/repair_device', [RepairController::class, 'index'])->name('repair_device');
    Route::get('repair_device', [RepairController::class, 'create'])->name('repairs.create');
    Route::post('repair_device', [RepairController::class, 'store'])->name('repairs.store');
    Route::post('/submit_repair_form', [RepairController::class, 'store'])->name('repair.store');
});

// -- Multi controllers forms (keep unchanged) -- //

Route::post('/clients', [ClientController::class, 'store']);
Route::post('/devices', [DeviceController::class, 'store']);
Route::post('/technicians', [TechnicianController::class, 'store']);

Route::get('/technician/register_repair', [TechnicianController::class, 'registerRepair'])->name('technician.register_repair');
Route::middleware(['auth', 'technician'])->group(function () {
    Route::get('/technician/register-view-data', [TechnicianController::class, 'registerViewData'])->name('technician.register_view_data');
});
Route::get('/technician/device', [TechnicianController::class, 'device'])->name('technician.device');
Route::get('/technicians', [TechnicianController::class, 'technicians'])->name('technician.technicians');

Route::middleware(['auth', 'technician'])->group(function () {
    Route::get('/technician/technicians', [TechnicianController::class, 'index'])->name('technician.technicians');
});

Route::middleware(['auth', 'technician'])->group(function () {
    Route::get('/technician/create', [TechnicianController::class, 'create'])->name('technician.create');
});


Route::post('/admin/register-device', [RegisterRepairController::class, 'registerDevice'])->name('admin.register_device');
Route::resource('register_repair', RegisterRepairController::class);
// PUBLIC route — no auth middleware
Route::get('manager/register_device', [ManagerController::class, 'registerDevice'])->name('manager.register_device');

// -- Other routes (register2, business type selection) -- //

Route::get('/register2', [RegisteredUserController::class, 'showRegister'])->name('auth.register2');
Route::post('/register2', [RegisteredUserController::class, 'register'])->name('auth.register2');
Route::get('/register2', [RegisteredUserController::class, 'showRegister2'])->name('auth.register2');
Route::post('/register2', [RegisteredUser2Controller::class, 'store'])->name('register2.store');
Route::get('/register2', [RegisteredUser2Controller::class, 'show'])->name('register2.show');
Route::post('/select-business-type', [BusinessTypeController::class, 'select'])->name('business.select');

// Display Clients,Devices and Technicians data

Route::get('/dashboard', [ActivityReportController::class, 'index'])->name('dashboard');
// Dashboard View
Route::get('/dashboard', [ActivityReportController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [ActivityReportController::class, 'index'])->name('dashboard');

Route::put('/api/clients/{id}', [ActivityReportController::class, 'updateClient']);
Route::put('/api/devices/{id}', [ActivityReportController::class, 'updateDevice']);
Route::put('/api/technicians/{id}', [ActivityReportController::class, 'updateTechnician']);
Route::get('/clients/{id}', [ActivityReportController::class, 'showClient'])->name('activity-report.client.show');
Route::get('/activity-report/client/{id}/edit', [ActivityReportController::class, 'editClient'])->name('activity-report.client.edit');
Route::get('/activity-report/device/{id}', [ActivityReportController::class, 'showDevice'])->name('activity-report.device.show');


Route::prefix('activity-report')->group(function () {
    // Existing routes...

    // ✅ Add this if missing:
    Route::get('/device/{id}/edit', [ActivityReportController::class, 'editDevice'])->name('activity-report.device.edit');
});

Route::prefix('activity-report')->group(function () {
    // ... other routes

    // ✅ Technician show route
    Route::get('/technician/{id}', [ActivityReportController::class, 'showTechnician'])->name('activity-report.technician.show');
});

Route::prefix('activity-report')->group(function () {
    // ✅ Add this technician edit route
    Route::get('/technician/{id}/edit', [ActivityReportController::class, 'editTechnician'])->name('activity-report.technician.edit');
});

Route::resource('clients', ClientController::class);

//
Route::prefix('admin')->group(function () {
    Route::get('/device', [DeviceController::class, 'index'])->name('admin.device');
});
Route::resource('devices', DeviceController::class);


//Technicians
Route::resource('technicians', TechnicianController::class);

Route::prefix('admin')->group(function () {
    Route::get('/technicians', [TechnicianController::class, 'index'])->name('admin.technicians');
});



Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/download/pdf', [ReportController::class, 'downloadPDF'])->name('reports.download.pdf');
Route::get('/reports/download/excel', [ReportController::class, 'downloadExcel'])->name('reports.download.excel');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/download/pdf', [ReportController::class, 'downloadPDF'])->name('reports.download.pdf');
Route::get('/reports/download/excel', [ReportController::class, 'downloadExcel'])->name('reports.download.excel');


