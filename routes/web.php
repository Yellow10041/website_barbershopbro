<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'view'])->name('home');


Route::get('/Booking/{city}', [DepartmentsController::class, 'departments'])->name('departments');

Route::get('/Booking/{city}/{id}', [DepartmentsController::class, 'department_view'])->name('department-view');



Route::post('/Booking/{city}/{id}/Order_Add', [OrdersController::class, 'order_add'])->name('order-add');

Route::post('/Profile/Order/Change/Rating', [OrdersController::class, 'order_change_rating'])->name('order-change-rating');

Route::get('/Profile/Order/Change/Status', [OrdersController::class, 'order_change_status'])->name('order-change-status');



Route::get('/Feedback', [FeedbackController::class, 'feedback'])->name('feedback');

Route::post('/Feedback/Add', [FeedbackController::class, 'feedback_add'])->name('feedback_add');

Route::post('/Feedback/Delete', [FeedbackController::class, 'feedback_delete'])->name('feedback-delete');



Route::get('/Login', function () {
    if (Auth::user()) return redirect()->route('profile');
    else return view('login');
})->name('login');

Route::get('/Register', function () {
    if (Auth::user()) return redirect()->route('profile');
    else return view('register');
})->name('register');



Route::post('/Register/Submit', [UserController::class, 'user_register'])->name('register_submit');

Route::post('/Login/Submit', [UserController::class, 'user_login'])->name('login_submit');

Route::get('/Logout', [UserController::class, 'user_logout'])->name('logout');

Route::get('/User/Update', [UserController::class, 'user_update'])->name('user-update');

Route::post('/User/Update-Photo', [UserController::class, 'user_update_photo'])->name('user-update-photo');



Route::get('/Profile', [ProfileController::class, 'view'])->name('profile');



Route::get('/About', function () {
    return view('about');
})->name('about');
