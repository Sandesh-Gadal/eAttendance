<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentCount;
use App\Models\Faculty; 

class StudentCountController extends Controller
{
    


public function fetch()
{  
    $faculties = Faculty::all(); // Get all faculties from the table
    return view('site.faculty', compact('faculties')); // Pass faculties to view
}




    public function store(Request $request)
    {
    
        // Validate the request
        $validated = $request->validate([
            'faculty_id' => 'required|exists:faculties,faculty_id', // Ensure faculty exists
            'section' => 'required|string|max:1', // Adjust validation as needed
            'semester_level' => 'required|integer',
            'student_number' => 'required|integer|min:0', // Ensure number is non-negative
        ]);
       
        // Create a new student count record
        StudentCount::create($validated);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Student count added successfully!');
    }
}
