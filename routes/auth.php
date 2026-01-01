<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\CompanyAuthController;
use App\Http\Controllers\auth\EmployeeAuthController;
use App\Http\Controllers\RolesAndCompanyManagement\CompanyRegistrationController;


Route::group(["prefix" => "auth"], function () {
    Route::post("login", [CompanyAuthController::class, "login"])->name("company.auth.login")->withoutMiddleware('auth');
    Route::get("logout", [CompanyAuthController::class, "logout"])->name("company.auth.logout")->middleware('auth');
    Route::get("register-page", [CompanyRegistrationController::class, "createCompany"])->name("register_page") ;
    Route::get("register-second_page/{id}", [CompanyRegistrationController::class, "createCompanyWithSchema"])->name("register_second_page") ;
});


Route::group(["prefix" => "auth/employee"], function () {
    Route::post("login", [EmployeeAuthController::class, "login"])->name("employee_login")->withoutMiddleware('auth');
    Route::get("logout", [EmployeeAuthController::class, "logout"])->name("employee.logout")->middleware('auth"employee');
});

// // Login Routes
Route::get('/', function () {
    
    // if (auth()->check()) { 
    //     return redirect()->route('main_dashboard');
    // } 
    return view('auth.login');
})->withoutMiddleware('auth')->name('login-page');



Route::group(["prefix" => "employee_dashboard"], function () {
    Route::get("/", [DashboardController::class, "index"])->name("employee_dashboard");
});