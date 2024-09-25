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

    public function storeOrUpdateOrDelete(Request $request)
    {
        $action = $request->input('action');
        $shiftId = $request->input('shift_id');
 
        if ($action == 'store') {
            $this->store($request);
        } elseif ($action == 'update') {
            $this->update($request, $shiftId);
        } elseif ($action == 'delete') {
            $this->destroy($shiftId);
        }

        return redirect()->route('shift')->with('success', ucfirst($action) . ' successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shift_name' => 'required|string|max:255',
            'shift_start_time' => 'required|date_format:H:i',
            'shift_end_time' => 'required|date_format:H:i|after:shift_start_time',
        ]);

        Shift::create($validated);

        return redirect()->route('shift')->with('success', 'Shift added successfully!');
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        $shift->update([
            'shift_name' => $request->input('shift_name'),
            'shift_start_time' => $request->input('shift_start_time'),
            'shift_end_time' => $request->input('shift_end_time'),
        ]);

        return redirect()->route('shift')->with('success', 'Shift updated successfully!');
    }

    public function destroy($shift_id)
    {
       
        $shift = Shift::findOrFail($shift_id);
        $shift->delete();

        return redirect()->route('shift')->with('success', 'Shift deleted successfully!');
    }
}
