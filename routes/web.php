<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentCountController;
use App\Http\Controllers\FetchFacultyController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentController;


// Faculty Routes
Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');
Route::delete('/faculty', [FacultyController::class, 'delete'])->name('faculty.delete');
Route::get('/faculty', [StudentCountController::class, 'index'])->name('studentCount.index');
Route::post('/student-counts/{student_count_id?}', [StudentCountController::class, 'storeOrUpdateOrDelete'])->name('studentCount.storeOrUpdateOrDelete');



Route::get('/', function () { return view('dashboard'); })->name('dashboard');
Route::get('/students', function () { return view('site/students'); })->name('students');
Route::get('/shift', function () { return view('site/shift'); })->name('shift');
Route::get('/attendance', function () { return view('site/attendance'); })->name('attendance');
Route::get('/devicesettings', function () { return view('site/device_settings'); })->name('devicesettings');


Route::get('/shift', [ShiftController::class, 'index'])->name('shift');
Route::post('/shift/{shift_id?}', [ShiftController::class, 'storeOrUpdateOrDelete'])->name('shift.storeOrUpdateOrDelete');



Route::group(['middleware' => ['web']], function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
});
