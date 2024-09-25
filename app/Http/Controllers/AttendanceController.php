<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Attendance;
use App\Model\Faculty;


class AttendanceController extends Controller
{
    public function index(){
           $attendanceData = Attendance::all();
           $faculties = Faculty::all();
        $shifts = Shift::all();
        return view('site.attendance', compact('attendanceData','faculties'));
    }
}
