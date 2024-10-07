<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentCountController;
use App\Http\Controllers\FetchFacultyController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;


// Faculty Routes
Route::post('/faculty/add', [FacultyController::class, 'store'])->name('faculty.store');
Route::delete('/faculty', [FacultyController::class, 'delete'])->name('faculty.delete');
Route::get('/faculty', [FacultyController::class, 'index']);



Route::get('/', function () { return view('dashboard'); })->name('dashboard');
Route::get('/shift', function () { return view('site/shift'); })->name('shift');
Route::get('/attendance', function () { return view('site/attendance'); })->name('attendance');
Route::get('/devicesettings', function () { return view('site/device_settings'); })->name('devicesettings');


Route::get('/shift', [ShiftController::class, 'index'])->name('shift');
Route::post('/shift/{shift_id?}', [ShiftController::class, 'storeOrUpdateOrDelete'])->name('shift.storeOrUpdateOrDelete');



Route::group(['middleware' => ['web']], function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/show/{student_nfc_id?}', [StudentController::class, 'show'])->name('students.show');
    Route::delete('/students/delete/{student_nfc_id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/search', [StudentController::class, 'search'])->name('students.search');
    Route::post('/students/filter', [StudentController::class, 'filter'])->name('students.filter');
    Route::get('/students/edit/{student_nfc_id?}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('students/update/{student_nfc_id?}', [StudentController::class, 'update'])->name('students.update');

});


// attendance route
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

Route::post('/attendance/filter', [AttendanceController::class, 'filterByDate']);
Route::post('/attendance/Durationfilter', [AttendanceController::class, 'filterByDuration'])->name('attendance.duration');
Route::post('/attendance/faculty', [AttendanceController::class, 'getFacultyAttendance'])->name('attendance.faculty');
Route::post('/attendance/semester', [AttendanceController::class, 'getSemesterAttendance'])->name('attendance.semester');
Route::post('/attendance/section', [AttendanceController::class, 'getSectionAttendance'])->name('attendance.section');
Route::post('/attendance/search', [AttendanceController::class, 'searchIndividualAttendance'])->name('attendance.search');
