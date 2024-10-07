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
        // foreach ($attendances as $attendance) {
        //     $student = $students->firstWhere('student_nfc_id', $attendance->student_nfc_id);
           
        // }

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
    $duration = $request->input('duration'); // Default to 30 days if no duration is selected
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
            $request->request->set('student_id_hidden', null);
    }

    return view('attendance.partials.individual_student', compact('student', 'attendances', 'duration', 'shift'));

} elseif ($request->has('facultyId')) {
    $faculty = Faculty::where('faculty_id', $request->input('facultyId'))->first();
    if ($faculty) {
        $startDate = now()->subDays($duration)->startOfDay();
        $endDate = now()->endOfDay();

        $attendances = Attendance::where('faculty_id', $faculty->faculty_id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get();

        return view('attendance.partials.faculty_attendance', compact('faculty', 'attendances'));
    }
}
}



public function getFacultyAttendance(Request $request)
{
    $faculty = Faculty::where('faculty_id', $request->input('facultyId'))->first();
    if ($faculty) {
        $duration = $request->input('duration', 30); // Default to 30 days if no duration is selected
        $startDate = now()->subDays($duration)->startOfDay();
        $endDate = now()->endOfDay();

        // Get all students of the faculty
        $students = Student::where('faculty_id', $faculty->faculty_id)->pluck('student_nfc_id');

        // Initialize an array to hold attendance summary
        $attendanceSummary = [];

        // Loop through each day in the duration
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $presentCount = 0;
            $absentCount = 0;

            foreach ($students as $studentNfcId) {
                $attendance = Attendance::where('student_nfc_id', $studentNfcId)
                    ->whereDate('attendance_date', $date)
                    ->first();

                if ($attendance) {
                    $presentCount++;
                } else {
                    $absentCount++;
                }
            }

            $attendanceSummary[] = [
                'date' => $date->toDateString(),
                'present' => $presentCount,
                'absent' => $absentCount,
            ];
        }

        return view('attendance.partials.faculty_attendance', compact('faculty', 'attendanceSummary', 'duration'));
        
    }

    // Handle the case where the faculty is not found
    return redirect()->back()->with('error', 'Faculty not found.');
}

}
