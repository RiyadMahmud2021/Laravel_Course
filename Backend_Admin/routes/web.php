<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;


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
// Dashboard
Route::get('/', [DashboardController::class, 'dashboardIndex']);
Route::get('/dashboard', [DashboardController::class, 'dashboardIndex']);

// Vistors Manage
Route::get('/visitors', [VisitorController::class, 'visitorIndex']);

// Services Mange
Route::get('/services', [ServiceController::class, 'serviceIndex']);
Route::get('/getServices', [ServiceController::class, 'getServiceData']);
Route::post('/deleteServices', [ServiceController::class, 'deleteServices']);
Route::post('/detailServices', [ServiceController::class, 'detailEachServices']);
Route::post('/updateServices', [ServiceController::class, 'updateServices']);
