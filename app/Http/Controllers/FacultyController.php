<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty; // Adjust if your model is named differently
use App\Models\Student;

class FacultyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'faculty_name' => 'required|string|max:255|unique:faculties,faculty_name',
            // Add more validation rules as needed
        ]);

        // Create a new faculty record
        Faculty::create($validated);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Faculty added successfully!');
        
        if (Faculty::where('faculty_name', $request->faculty_name)->exists()) {
            return redirect()->back()->with('error', 'Faculty already exists!');
        }
        
    }

  
        public function index()
        {
            // Fetch all faculties
            $faculties = Faculty::all();
    
            // Calculate total students and total semesters for each faculty
            $faculties = $faculties->map(function ($faculty) {
                $totalStudents = Student::where('faculty_id', $faculty->faculty_id)->count();
                $totalSemesters = Student::where('faculty_id', $faculty->faculty_id)
                                          ->distinct()
                                          ->count('student_semester');
    
                // Add the calculated data to the faculty object
                $faculty->total_students = $totalStudents;
                $faculty->total_semesters = $totalSemesters;
          
    
                return $faculty;
            });
          
    
            // Use dd() to check the data in the console (optional)
            // dd($faculties);
    
            // Return the view with the fetched faculties
            return view('site.faculty', compact('faculties'));
        }


    public function delete(Request $request)
    {
        // Find the faculty by its ID
        $faculty = Faculty::find($request->faculty_id);

        // If faculty exists, delete it
        if ($faculty) {
            $faculty->delete();
            return redirect()->back()->with('success', 'Faculty deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Faculty not found.');
        }
    }
}
