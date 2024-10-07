<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller{
public function index()
{
    // Count total students
    $totalStudents = Student::count();

    // Get today's date
    $today = now()->toDateString();

    // Count present students for today
    $presentCount = Attendance::whereDate('attendance_date', $today)->distinct('student_nfc_id')->count('student_nfc_id');
    $absentCount = $totalStudents - $presentCount;

    // Get attendance data for the last 7 days
    $attendanceData = Attendance::select(DB::raw('DATE(attendance_date) as attendance_date'), DB::raw('COUNT(student_nfc_id) as present_count'))
        ->where('attendance_date', '>=', now()->subDays(30)) // Last 7 days
        ->groupBy('attendance_date')
        ->orderBy('attendance_date')
        ->get();

    // Prepare labels and data for the chart
    $labels = $attendanceData->pluck('attendance_date')->toArray();
    $presentData = $attendanceData->pluck('present_count')->toArray();

    // Calculate absent counts for the last 7 days
    $absentData = [];
    foreach ($presentData as $count) {
        $absentCountForDay = $totalStudents - $count; // Total students minus present count
        $absentData[] = $absentCountForDay; // Store absent count for each day
    }

    return view('dashboard', [
        'chartData' => [
            'totalStudents' => $totalStudents,
            'presentCount' => $presentCount,
            'absentCount' => $absentCount,
            'attendanceData' => [
                'labels' => $labels,
                'presentData' => $presentData,
                'absentData' => $absentData,
            ],
        ],
    ]);
}
}
