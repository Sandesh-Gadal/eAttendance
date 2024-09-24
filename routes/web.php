<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentCountController;
use App\Http\Controllers\FetchFacultyController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentInfoController;

// Faculty Routes
Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');

Route::get('/faculty', [FetchFacultyController::class, 'fetch_faculty_table'])->name('faculty.form');


// Student Count Routes
Route::get('/student_counts', [StudentCountController::class, 'index'])->name('student.counts');
Route::post('/student_counts', [StudentCountController::class, 'store'])->name('student_count.store');



// Other Routes
Route::get('/', function () { return view('dashboard'); })->name('dashboard');
Route::get('/students', function () { return view('site/students'); })->name('students');
// Route::get('/faculty', function () { return view('site/faculty');})->name('faculty');

Route::get('/shift', function () { return view('site/shift'); })->name('shift');
Route::get('/attendance', function () { return view('site/attendance'); })->name('attendance');
Route::get('/devicesettings', function () { return view('site/device_settings'); })->name('devicesettings');


// Route::resource('shift', ShiftController::class);

// Display all shifts
Route::get('/shift', [ShiftController::class, 'index'])->name('shift');

// Store a new shift
Route::post('/shift', [ShiftController::class, 'store'])->name('shift.store');

// Update an existing shift
Route::put('/shift/{id}', [ShiftController::class, 'update'])->name('shift.update');

// Delete a shift
Route::delete('shift/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy');



Route::post('/students', [StudentInfoController::class, 'store'])->name('students.store');

