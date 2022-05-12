<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;

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
Route::post('/addServices', [ServiceController::class, 'addServices']);

// Courses Mange
Route::get('/courses', [CourseController::class, 'coursesIndex']);
Route::get('/getCourses', [CourseController::class, 'getCoursesData']);
Route::post('/addCourse', [CourseController::class, 'addCourse']);
Route::post('/detailCourse', [CourseController::class, 'detailEachCourse']);
Route::post('/updateCourse', [CourseController::class, 'updateCourse']);
Route::post('/deleteCourse', [CourseController::class, 'deleteCourse']);

// Project Mange
Route::get('/projects', [ProjectController::class, 'projectIndex']);
Route::get('/getProjects', [ProjectController::class, 'getProjectData']);
Route::post('/addProject', [ProjectController::class, 'addProject']);
Route::post('/detailProject', [ProjectController::class, 'detailEachProject']);
Route::post('/updateProject', [ProjectController::class, 'updateProject']);
Route::post('/deleteProject', [ProjectController::class, 'deleteProject']);

// Contact Mange
Route::get('/contacts', [ContactController::class, 'contactIndex']);
Route::get('/getContacts', [ContactController::class, 'getContactData']);
// Route::post('/addContact', [ProjectController::class, 'addContact']);
// Route::post('/detailContact', [ProjectController::class, 'detailEachContact']);
// Route::post('/updateContact', [ProjectController::class, 'updateContact']);
Route::post('/deleteContact', [ContactController::class, 'deleteContact']);

// Review Manage
Route::get('/reviews', [ReviewController::class, 'reviewIndex']);
Route::get('/getReviews', [ReviewController::class, 'getReviewData']);
Route::post('/addReview', [ReviewController::class, 'addReview']);
Route::post('/deleteReview', [ReviewController::class, 'deleteReview']);
Route::post('/reviewDetails', [ReviewController::class, 'getReviewDetails']);
Route::post('/reviewUpdate',[ReviewController::class, 'reviewUpdate']);