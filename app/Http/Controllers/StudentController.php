<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Shift;

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::with(['faculty', 'shift'])->get(); 
        $faculties = Faculty::all();
        $shifts = Shift::all();
        return view('students.students', compact('students','faculties','shifts'));
    }

    public function create()
    {
        $faculties = Faculty::all();
        $shifts = Shift::all();
        return view('students.form', compact('faculties','shifts'));
    }
    public function store(Request $request)
    {
        // \dd($request->all());
        $validated= $request->validate([
            'student_nfc_id' => 'required|integer|unique:students,student_nfc_id', // Ensure it's required, an integer, and unique
            'student_name' => 'required|string|max:255', // Max length validation for name
            'student_rollno' => 'required|string|max:255|unique:students,student_rollno', // Ensure roll number is unique
            'student_dob' => 'required|date',
            'student_semester' => 'required|string|max:255',
            'student_section' => 'required|string|max:255',
            'faculty_id' => 'required|integer|exists:faculties,faculty_id', // Ensure faculty ID exists in the faculties table
            'shift_id' => 'required|integer|exists:shifts,shift_id', // Ensure shift ID exists in the shifts table
            'student_contact' => 'required|string|max:255', // Max length validation
            'student_address' => 'required|string|max:255',
            'student_guardian_phno' => 'required|string|max:255',
        ]);
    
        Student::create($validated);
        
    
        return redirect()->route('students.index')->with('alert', 'Student added successfully!');
    }
    
    public function show($student_nfc_id)
    {
        $student = Student::findOrFail($student_nfc_id);
        $faculty = Faculty::where('faculty_id', $student->faculty_id)->first();
        $shift = Shift::where('shift_id', $student->shift_id)->first();
        $faculties = Faculty::all();
        $shifts = Shift::all();
        $students = Student::with(['faculty', 'shift'])->get(); 
    
    return view('students.view', compact('student', 'faculty', 'shift' ,'faculties','shifts','students'));
    }

    public function edit($student_nfc_id)
    {   
      
        $student = Student::findOrFail($student_nfc_id);
        $faculty = Faculty::where('faculty_id', $student->faculty_id)->first();
        $shift = Shift::where('shift_id', $student->shift_id)->first();
        $faculties = Faculty::all();
        $shifts = Shift::all();
        $students = Student::with(['faculty', 'shift'])->get(); 
    
    return view('students.edit', compact('student', 'faculty', 'shift' ,'faculties','shifts','students'));
    }
    
    public function update(Request $request)
    {
            
        $student_nfc_id = $request->input('student_nfc_id1');
        $student = Student::where('student_nfc_id', $student_nfc_id)->firstOrFail();

//  \dd($student_nfc_id);
       
            $validated = $request->validate([
                    // 'student_nfc_id' => 'required|integer|unique:students,student_nfc_id,' . $student->$student_nfc_id . ',student_nfc_id', // Ensure it's required, an integer, and unique
            'student_name' => 'required|string|max:255', // Max length validation for name
            'student_rollno' => 'required|string|max:255|unique:students,student_rollno,' . $student->student_rollno . ',student_rollno', // Ensure roll number is uniqu
                'student_dob' => 'required|date',
                'student_semester' => 'required|string|max:255',
                'student_section' => 'required|string|max:255',
                'faculty_id' => 'required|integer|exists:faculties,faculty_id', // Ensure faculty ID exists in the faculties table
                'shift_id' => 'required|integer|exists:shifts,shift_id', // Ensure shift ID exists in the shifts table
                'student_contact' => 'required|string|max:255', // Max length validation
                'student_address' => 'required|string|max:255',
                'student_guardian_phno' => 'required|string|max:255',
            ]);
       
        $students = Student::findOrFail($student_nfc_id);

//         // Update the student record
        $student->update($validated);
   

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }
    

    // public function destroy($student_nfc_id)
    // {
    //    dd($student_nfc_id);
    //     $student = Student::where('student_nfc_id', $student_nfc_id)->firstOrFail();
    //     $student->delete();

    //     return redirect()->route('students.students')
    //                     ->with('success', 'Student deleted successfully.');
    // }
   
// app/Http/Controllers/StudentController.php
public function destroy($student_nfc_id)
{
    $student = Student::where('student_nfc_id', $student_nfc_id)->firstOrFail();
    $student->delete();

    $students = Student::all(); // Fetch the updated list of students

    $view = view('students.partials.student_list', compact('students'))->render();

    return response()->json(['success' => 'Student deleted successfully', 'html' => $view]);
}



    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $students = Student::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('student_name', 'LIKE', '%' . $query . '%')
                ->orWhere('student_nfc_id', 'LIKE', '%' . $query . '%');
        })->get();
    
        $faculties = Faculty::all();
        if ($request->ajax()) {
            return view('students.partials.student_list', compact('students'));
        }
    
        return view('students.students', compact('students', 'faculties'));
    }
    
    public function filter(Request $request)
    {
        $query = Student::query(); // Initialize the query builder
    
        // Filter based on input
        if ($request->filled('semester')) {
            $query->where('student_semester', $request->semester);
        }
        if ($request->filled('section')) {
            $query->where('student_section', $request->section);
        }
        if ($request->filled('faculty')) {
            $query->where('faculty_id', $request->faculty);
        }
    
        // Execute the query to get the filtered students
        $students = $query->get();
    
        // Render the partial view with the filtered students
        $view = view('students.partials.student_list', compact('students'))->render();
    
        // Return the rendered view as a JSON response
        return response()->json(['html' => $view]);
    }
    

}
