<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('tasks', \App\Http\Controllers\TasksController::class);

    Route::resource('users', \App\Http\Controllers\UsersController::class);
    
    // Route::get('payrolls/{id}' , [\App\Http\Controllers\PayrollController::class,'show'])->name('/payrolls');
    Route::resource('payroll', \App\Http\Controllers\PayrollController::class);
    Route::post('/{id}',[PayrollController::class,'store']);

    //Route for attendance
    Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);
    //Route::get('/{id}', [AttendanceController::class, 'store']);
});


