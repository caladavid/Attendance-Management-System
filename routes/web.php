<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('can:admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('admin/users', UserController::class)->middleware('can:admin.index')->names("admin.users");
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/time-in', [AttendanceController::class, 'timeIn'])->name('attendance.time_in');
    Route::post('/attendance/time-out', [AttendanceController::class, 'timeOut'])->name('attendance.time_out');
    Route::resource('admin/departments', DepartmentController::class)->middleware('can:admin.index')->names("admin.departments");
    Route::resource('admin/shift', ShiftController::class)->middleware('can:admin.index')->names("admin.shift");
    Route::get('admin/report', [ReportController::class, 'index'])->name('admin.report')->middleware('can:admin.index');
    Route::get('admin/report/download-pdf', [ReportController::class, 'downloadPDF'])->name('admin.download-pdf')->middleware('can:admin.index');

});

require __DIR__.'/auth.php';
