<?php

use App\Http\Controllers\Mails\SendMailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProfileController::class, 'index']);

Route::prefix('/profile')->group(function () {
    Route::post('/update/{id}', [ProfileController::class, 'update']);
    Route::post('/delete/{id}', [ProfileController::class, 'delete']);
});

Route::prefix('/reports')->group(function () {
    Route::get('/', [ReportsController::class, 'index']);
    Route::get('/create', [ReportsController::class, 'createIndex']);
    Route::post('/create', [ReportsController::class, 'create']);
    Route::get('/view/{id}', [ReportsController::class, 'view']);
    Route::post('/update/{id}', [ReportsController::class, 'update']);
    Route::post('/delete/{id}', [ReportsController::class, 'delete']);
    Route::get('/linkprofile/{id}', [ReportsController::class, 'linkProfileIndex']);
    Route::post('/linkprofile/delete/{report_id}/{profile_id}', [ReportsController::class, 'linkProfileDelete']);
});

Route::get('/sendreport/{id}', [SendMailController::class, 'sendMail']);
