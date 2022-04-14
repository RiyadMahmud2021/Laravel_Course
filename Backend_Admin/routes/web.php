<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;

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
 
Route::get('/', [DashboardController::class, 'dashboardIndex']);
Route::get('/dashboard', [DashboardController::class, 'dashboardIndex']);
Route::get('/visitors', [VisitorController::class, 'visitorIndex']);