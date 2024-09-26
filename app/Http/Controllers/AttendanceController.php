<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Faculty;


class AttendanceController extends Controller
{
    public function index(){
           $attendanceData = Attendance::all();
           $faculties = Faculty::all();
      
        return view('site.attendance', compact('attendanceData','faculties'));
    }
}
