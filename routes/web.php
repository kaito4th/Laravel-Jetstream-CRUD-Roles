<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\OtherDeductionController;
use App\Http\Controllers\IncreaseController;
use App\Http\Controllers\UsersController;

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
    Route::get('edit/{id}', [UsersController::class, 'edit']);
    
    // Route::get('payrolls/{id}' , [\App\Http\Controllers\PayrollController::class,'show'])->name('/payrolls');
    Route::resource('payroll', \App\Http\Controllers\PayrollController::class);
    Route::post('/{id}',[PayrollController::class,'store']);

    //Route for attendance
    Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);
    Route::post('/{id}', [AttendanceController::class, 'store']);
    Route::get('/payroll/{id}/attendance/delete/{iid}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

    //Route for Deduction
    Route::resource('otherdeduction', \App\Http\Controllers\OtherDeductionController::class);
    Route::post('/payroll/otherdeduction/{id}', [OtherDeductionController::class, 'store']);
    Route::get('/payroll/{id}/otherdeduction/delete/{iid}', [OtherDeductionController::class, 'destroy'])->name('otherdeduction.destroy');

    //Route for Increase
    Route::resource('increase', \App\Http\Controllers\IncreaseController::class);
    Route::post('/payroll/increase/{id}', [IncreaseController::class, 'store']);
    Route::get('/payroll/{id}/increase/delete/{iid}', [IncreaseController::class, 'destroy'])->name('increase.destroy');

    //Route for Print
    Route::get('/payslip/{user_id}', [PayrollController::class, 'print']);
    Route::get('/allpayslip', [PayrollController::class, 'allprint']);


});


