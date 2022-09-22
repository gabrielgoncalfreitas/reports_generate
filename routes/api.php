<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/profiles', [ProfileController::class, 'index']);
Route::put('/profiles/create', [ProfileController::class, 'create']);

Route::put('/reports/create', [ReportsController::class, 'create']);
Route::put('/reports/linkprofile/link', [ReportsController::class, 'linkProfileLink']);
