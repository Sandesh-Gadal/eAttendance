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
    public function index(Request $request)
    {
        $attendances = Attendance::all();
        $faculties = Faculty::all();
        $students = Student::all();
        $duration = $request->input('duration', 30); 
        foreach ($attendances as $attendance) {
            $student = $students->firstWhere('student_nfc_id', $attendance->student_nfc_id);
           
        }

        return view('attendance.attendance', compact('attendances', 'faculties', 'students','duration'));
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
            $duration = $request->input('duration', 30);
// dd($student, $attendances, $faculties, $shifts);
        
            if ($request->ajax()) {
                // Return the attendance partial if the request is AJAX
                return view('attendance.partials.individual_student', compact('student', 'attendances', 'faculties','shift','duration'));
            }
        
            // For non-AJAX requests, you can still return the main view if necessary
            return view('attendance.attendance', compact('student', 'attendances', 'faculties','shift','duration'));
    
}




public function filterByDuration(Request $request)
{
    $duration = $request->input('duration', 30); // Default to 30 days if no duration is selected
    $student = null;
    $attendances = collect();
    $shift = null;

    if ($request->has('student_id_hidden')) {
        $student = Student::where('student_nfc_id', $request->input('student_id_hidden'))->first();
        if ($student) {
            $shift = Shift::find($student->shift_id);

            $startDate = now()->subDays($duration)->startOfDay();
            $endDate = now()->endOfDay();

            $attendances = Attendance::where('student_nfc_id', $student->student_nfc_id)
                ->whereBetween('attendance_date', [$startDate, $endDate])
                ->get();
        }
    }

    return view('attendance.partials.individual_student', compact('student', 'attendances', 'duration', 'shift'));
}


}
