<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\StudentInfo;

class StudentInfoController extends Controller
{
    public function store(Request $request)
    { 
        $request->validate([
            'student_id' => 'required|string',
            'student_rollno' => 'required|string',
            'student_dob' => 'required|date',
            'faculty_id' => 'required|string',
            'semester' => 'required|integer',
            'shift_id' => 'required|string',
            'student_name' => 'required|string',
            'student_section' => 'required|string',
            'student_contact' => 'required|string',
            'student_guardian_phno' => 'required|string',
            'student_address' => 'required|string',
        ]);

        StudentInfo::create($request->all());

        return redirect()->back()->with('success', 'Student count added successfully!');
    }
}
