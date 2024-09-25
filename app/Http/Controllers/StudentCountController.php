<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentCount;
use App\Models\Faculty;

class StudentCountController extends Controller
{


    public function index(){
 
        $faculties = Faculty::all();
        $studentCounts = StudentCount::with('faculty')->get();
        // dd($faculties, $studentCounts);
        return view("site.faculty",compact("faculties","studentCounts"));
    }
    // Store, Update, or Delete based on the action
    public function storeOrUpdateOrDelete(Request $request)
    {
        $action = $request->input('action');
        $studentcountid = $request->input('student_count_id');
 
        if ($action == 'store') {
            $this->store($request);
        } elseif ($action == 'update') {
            $this->update($request, $studentcountid);
        } elseif ($action == 'delete') {
            $this->destroy($request, $studentcountid);
        }

        return redirect()->back()->with('success', ucfirst($action) . ' successfully!');
    }

    public function store(Request $request)
    {
        $existingRecord = StudentCount::where('faculty_id', $request->input('faculty_id'))
        ->where('semester_level', $request->input('semester_level'))
        ->where('section', $request->input('section'))
        ->first();

    if ($existingRecord) {
        // Return back with a session variable to show the alert in the view

        return redirect()->back()->with('alert', 'This faculty with the same semester and section already exists.');
    }

    $validated = $request->validate([
        'faculty_id' => 'required|exists:faculties,faculty_id', // Validate that faculty_id exists in the faculties table
        'section' => 'required|in:A,B', // Validate that section is either 'A' or 'B'
        'semester_level' => 'required|integer|min:1|max:9', // Validate semester_level is between 1 and 9
        'student_number' => 'required|integer|min:1', // Validate student_number is a positive integer
    ], [
        // Custom error messages (optional)
        'faculty_id.required' => 'Please select a faculty.',
        'section.required' => 'Please select a section.',
        'semester_level.required' => 'Please select a semester.',
        'student_number.required' => 'Please enter the total number of students.',
    ]);

    StudentCount::create($validated);

    // Proceed to store the record if no duplicate exists
    // $studentCount = new StudentCount();
    // $studentCount->faculty_id = $request->input('faculty_id');
    // $studentCount->section = $request->input('section');
    // $studentCount->semester_level = $request->input('semester_level');
    // $studentCount->student_number = $request->input('student_number');
    // $studentCount->save();

    return redirect()->route('studentCount.index')->with('success', 'Student count added successfully!');
    }

    public function update(Request $request, $studentcountid)
    {
        $existingRecord = StudentCount::where('faculty_id', $request->input('faculty_id'))
        ->where('semester_level', $request->input('semester_level'))
        ->where('section', $request->input('section'))
        ->where('id', '!=', $studentcountid)
        ->first();

    if ($existingRecord) {
        // Return back with a session variable to show the alert in the view
        return redirect()->back()->with('duplicate', 'This faculty with the same semester and section already exists.');
    }

    // Proceed to update the record if no duplicate exists
    $studentCount = StudentCount::findOrFail($studentcountid);
       $studentCount->update([
       
        'faculty_id'=> $request->input('faculty_id'),
        'section'=> $request->input('section'),
        'semester_level'=> $request->input('semester_level'),
        'student_number'=> $request->input('student_number')
       ]);

       return redirect()->route('studentCount.index')->with('success', 'Shift updated successfully!');
    // if ($studentCount) {
    //     $studentCount->faculty_id = $request->input('faculty_id');
    //     $studentCount->section = $request->input('section');
    //     $studentCount->semester_level = $request->input('semester_level');
    //     $studentCount->student_number = $request->input('student_number');
    //     $studentCount->save();

    //     return redirect()->back()->with('success', 'Student count updated successfully!');
    // } else {
    //     return redirect()->back()->with('error', 'Student count not found.');
    // }
    }

    public function destroy(Request $request ,$studentcountid)
    {
       
        $studentCount = StudentCount::find($request->input('student_count_id'));

        if ($studentCount) {
            $studentCount->delete();
            return redirect()->back()->with('success', 'Student count deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Student count not found.');
        }
    }
}
