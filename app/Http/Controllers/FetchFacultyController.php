<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty; 
use App\Models\StudentCount; 
use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;

class FetchFacultyController extends Controller
{
    public function fetch_faculty_table()
    {
        // Create the query to fetch faculty data with associated student counts
        $facultyData = Faculty::with(['studentCounts' => function($query) {
            $query->select('faculty_id', 
                DB::raw('count(*) as total_students'), 
                DB::raw('count(distinct semester_level) as total_semesters')
            )
            ->groupBy('faculty_id');
        }])->get();
    
        // Debugging: Check what facultyData contains
      
    
        // Calculate the number of registered students for each faculty
        foreach ($facultyData as $faculty) {
            $faculty->registered_students = StudentInfo::where('faculty_id', $faculty->id)->count();
        }
    
        // Fetch all faculties for the select box in the form
        $faculties = Faculty::all();
        // dd($facultyData , $faculties); 
        // Return the view with the fetched data
        return view('site.faculty', compact('facultyData', 'faculties'));
    }
    
    
 
}
