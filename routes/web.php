<?php

use App\Http\Controllers\Mails\SendMailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index']); # Returns the profiles page

Route::prefix('/profile')->group(function () {
    Route::post('/update/{id}', [ProfileController::class, 'update']); # Update profile
    Route::post('/delete/{id}', [ProfileController::class, 'delete']); # Delete profile
});

Route::prefix('/reports')->group(function () {
    Route::get('/', [ReportsController::class, 'index']); # Reports home page
    Route::get('/create', [ReportsController::class, 'createReport']); # Returns the reports create page
    Route::post('/create', [ReportsController::class, 'create']); # Using POST method this route create the report
    Route::get('/view/{id}', [ReportsController::class, 'view']); # Returns the report and the linked profiles
    Route::post('/update/{id}', [ReportsController::class, 'update']); # Using POST method this route update the report
    Route::post('/delete/{id}', [ReportsController::class, 'delete']); # Using POST methos this route delete the report
    Route::get('/linkprofile/{id}', [ReportsController::class, 'linkProfileIndex']); # Returns the link profile view using the report id as parameter
    Route::post('/linkprofile/delete/{report_id}/{profile_id}', [ReportsController::class, 'linkProfileDelete']); # Remove the linked profile from report
});

Route::get('/sendreport/{id}', [SendMailController::class, 'sendMail']); # Route used to send report to email
