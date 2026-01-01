<?php

 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\RolesAndCompanyManagement\CompanyRegistrationController;



Route::group(["prefix" => "register_company"], function () {
    Route::post('/' , [CompanyRegistrationController::class , 'store'])->name('company_registration');
});