<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\EmployeeAuthController;

 

Route::group(["prefix" => "employee_dashboard"], function () {
    Route::get("/", [DashboardController::class, "index"])->name("employee_dashboard");
});