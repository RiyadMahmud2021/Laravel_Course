<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ContactController;

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

Route::get('/', [HomeController::class, 'homeIndex']);
Route::post('/sendContact', [HomeController::class, 'sendContact']);

Route::get('/projects', [ProjectController::class, 'projectIndex']);

Route::get('/courses', [CourseController::class, 'courseIndex']);

Route::get('/policy', [PolicyController::class, 'policyIndex']);

Route::get('/terms', [TermsController::class, 'termsIndex']);

Route::get('/contact', [ContactController::class, 'contactIndex']);