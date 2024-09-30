<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Shift;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $faculties = Faculty::all();
        $students = Student::all();

        foreach ($attendances as $attendance) {
            $student = $students->firstWhere('student_nfc_id', $attendance->student_nfc_id);
            $attendance->remarks = $this->getAttendanceRemark($student, $attendance);
        }

        return view('attendance.attendance', compact('attendances', 'faculties', 'students'));
    }

    private function getAttendanceRemark($student, $attendance)
    {
        $shift = Shift::find($student->shift_id);

        if ($attendance->attendance_entry_time <= $shift->shift_start_time) {
            return 'On Time';
        } else {
            return 'Late';
        }
    }
    public function searchIndividualAttendance(Request $request)
    {
        $query = $request->input('student_nfc_id');
        
        // Get the current date
        $currentDate = now();
        $startDate = $currentDate->copy()->subMonth()->startOfDay();
        $endDate = $currentDate->endOfDay();
        
        // Fetch student and their attendances
        $student = Student::where('student_nfc_id', $query)->first();
        $attendances = Attendance::where('student_nfc_id', $query)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get();

            $faculties = Faculty::all(); // Fetch all faculties
            $shift= $student ? Shift::find($student->shift_id) : null;
// dd($student, $attendances, $faculties, $shifts);
        
            if ($request->ajax()) {
                // Return the attendance partial if the request is AJAX
                return view('attendance.partials.individual_student', compact('student', 'attendances', 'faculties','shift'));
            }
        
            // For non-AJAX requests, you can still return the main view if necessary
            return view('attendance.attendance', compact('student', 'attendances', 'faculties','shift'));
    
}
}