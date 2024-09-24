<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all(); // Fetch all shifts
        return view('site.shift', compact('shifts'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'shift_name' => 'required|string|max:255',
            'shift_start_time' => 'required|date_format:H:i',
            'shift_end_time' => 'required|date_format:H:i|after:shift_start_time',
        ]);
 
        Shift::create($validated);
        return redirect()->route('shift')->with('success', 'Shift added successfully!');
    }

    public function update(Request $request, $id) {
        // Validate and find the shift by ID
        $shift = Shift::findOrFail($id);
    
        // Update the shift data
        $shift->shift_name = $request->input('shift_name');
        $shift->shift_start_time = $request->input('shift_start_time');
        $shift->shift_end_time = $request->input('shift_end_time');
        
        // Save the updated shift
        $shift->save();
    
        // Redirect back with success message
        return redirect()->route('shift.index')->with('success', 'Shift updated successfully!');
    }
    
    
    public function destroy($id) {
        // Find the shift by ID and delete it
        $shift = Shift::findOrFail($id);
        $shift->delete();
        dd($shift);
    
        return redirect()->route('shift.index')->with('success', 'Shift deleted successfully!');
    }
}
