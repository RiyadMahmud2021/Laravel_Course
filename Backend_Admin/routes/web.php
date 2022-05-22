<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoGalleryController;

use App\Http\Middleware\LoginMiddleware;


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
Route::get('/dashboard', [DashboardController::class, 'dashboardIndex'])->middleware('loginCheck');

// Vistors Manage
Route::get('/visitors', [VisitorController::class, 'visitorIndex'])->middleware('loginCheck');

// Services Mange
Route::get('/services', [ServiceController::class, 'serviceIndex'])->middleware('loginCheck');
Route::get('/getServices', [ServiceController::class, 'getServiceData'])->middleware('loginCheck');
Route::post('/deleteServices', [ServiceController::class, 'deleteServices'])->middleware('loginCheck');
Route::post('/detailServices', [ServiceController::class, 'detailEachServices'])->middleware('loginCheck');
Route::post('/updateServices', [ServiceController::class, 'updateServices'])->middleware('loginCheck');
Route::post('/addServices', [ServiceController::class, 'addServices'])->middleware('loginCheck');

// Courses Mange
Route::get('/courses', [CourseController::class, 'coursesIndex'])->middleware('loginCheck');
Route::get('/getCourses', [CourseController::class, 'getCoursesData'])->middleware('loginCheck');
Route::post('/addCourse', [CourseController::class, 'addCourse'])->middleware('loginCheck');
Route::post('/detailCourse', [CourseController::class, 'detailEachCourse'])->middleware('loginCheck');
Route::post('/updateCourse', [CourseController::class, 'updateCourse'])->middleware('loginCheck');
Route::post('/deleteCourse', [CourseController::class, 'deleteCourse'])->middleware('loginCheck');

// Project Mange
Route::get('/projects', [ProjectController::class, 'projectIndex'])->middleware('loginCheck');
Route::get('/getProjects', [ProjectController::class, 'getProjectData'])->middleware('loginCheck');
Route::post('/addProject', [ProjectController::class, 'addProject'])->middleware('loginCheck');
Route::post('/detailProject', [ProjectController::class, 'detailEachProject'])->middleware('loginCheck');
Route::post('/updateProject', [ProjectController::class, 'updateProject'])->middleware('loginCheck');
Route::post('/deleteProject', [ProjectController::class, 'deleteProject'])->middleware('loginCheck');

// Contact Mange
Route::get('/contacts', [ContactController::class, 'contactIndex'])->middleware('loginCheck');
Route::get('/getContacts', [ContactController::class, 'getContactData'])->middleware('loginCheck');
// Route::post('/addContact', [ProjectController::class, 'addContact']);
// Route::post('/detailContact', [ProjectController::class, 'detailEachContact']);
// Route::post('/updateContact', [ProjectController::class, 'updateContact']);
Route::post('/deleteContact', [ContactController::class, 'deleteContact'])->middleware('loginCheck');

// Review Manage
Route::get('/reviews', [ReviewController::class, 'reviewIndex'])->middleware('loginCheck');
Route::get('/getReviews', [ReviewController::class, 'getReviewData'])->middleware('loginCheck');
Route::post('/addReview', [ReviewController::class, 'addReview'])->middleware('loginCheck');
Route::post('/deleteReview', [ReviewController::class, 'deleteReview'])->middleware('loginCheck');
Route::post('/reviewDetails', [ReviewController::class, 'getReviewDetails'])->middleware('loginCheck');
Route::post('/reviewUpdate',[ReviewController::class, 'reviewUpdate'])->middleware('loginCheck');

// Photo Gallery
Route::get('/photoGallery', [PhotoGalleryController::class, 'photoIndex'])->middleware('loginCheck');
Route::post('/photoUpload', [PhotoGalleryController::class, 'photoUpload'])->middleware('loginCheck');
Route::get('/photos', [PhotoGalleryController::class, 'photos'])->middleware('loginCheck');
Route::get('/photosById/{id}', [PhotoGalleryController::class, 'photosById'])->middleware('loginCheck');
Route::post('/photoDelete', [PhotoGalleryController::class, 'photoDelete'])->middleware('loginCheck');

// Login
Route::get('/', [LoginController::class, 'loginIndex']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);


