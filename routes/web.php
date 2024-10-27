<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentCountController;
use App\Http\Controllers\FetchFacultyController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\auth\AdminController;

// Public routes
Route::get('/login', function () {return view("auth.login");})->name("login");

Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

// Protected routes
Route::middleware('auth:admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Faculty Routes
    Route::post('/faculty/add', [FacultyController::class, 'store'])->name('faculty.store');
    Route::delete('/faculty', [FacultyController::class, 'delete'])->name('faculty.delete');
    Route::get('/faculty', [FacultyController::class, 'index']);

    // Shift Routes
    Route::get('/shift', [ShiftController::class, 'index'])->name('shift');
    Route::post('/shift/{shift_id?}', [ShiftController::class, 'storeOrUpdateOrDelete'])->name('shift.storeOrUpdateOrDelete');

    // Student Routes
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/show/{student_nfc_id?}', [StudentController::class, 'show'])->name('students.show');
    Route::delete('/students/delete/{student_nfc_id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/search', [StudentController::class, 'search'])->name('students.search');
    Route::post('/students/filter', [StudentController::class, 'filter'])->name('students.filter');
    Route::get('/students/edit/{student_nfc_id?}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/update/{student_nfc_id?}', [StudentController::class, 'update'])->name('students.update');

    // Attendance Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/filter', [AttendanceController::class, 'filterByDate']);
    Route::post('/attendance/Durationfilter', [AttendanceController::class, 'filterByDuration'])->name('attendance.duration');
    Route::post('/attendance/faculty', [AttendanceController::class, 'getFacultyAttendance'])->name('attendance.faculty');
    Route::post('/attendance/semester', [AttendanceController::class, 'getSemesterAttendance'])->name('attendance.semester');
    Route::post('/attendance/section', [AttendanceController::class, 'getSectionAttendance'])->name('attendance.section');
    Route::post('/attendance/search', [AttendanceController::class, 'searchIndividualAttendance'])->name('attendance.search');

    // Logout Route
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
