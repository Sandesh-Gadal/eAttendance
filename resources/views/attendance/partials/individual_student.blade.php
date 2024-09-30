@if($student)
<div class="student-box">
    <p><strong>Name: &ensp;{{ $student->student_name }}</strong></p>
    <p><strong>NFC ID: &ensp;{{ $student->student_nfc_id }}</strong></p>
</div>
@endif

<table class="attendance-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Remarks</th>
            <th>Attendance</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Get the date range for the past month
            $startDate = now()->subMonth()->startOfDay();
            $endDate = now()->endOfDay();
            $dates = [];
            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $dates[] = $date->copy();
            }
        @endphp
        
        @foreach ($dates as $date)
        @php
            // Find attendance for the current date
            $attendance = $attendances->where('attendance_date', $date->toDateString())->first();

            // Determine shift start time, assuming it's passed from the controller
            $shiftStartTime = $shift ? Carbon\Carbon::parse($shift->shift_start_time) : null;

            // Determine if attendance is on time or late
            if ($attendance) {
                $entryTime = Carbon\Carbon::parse($attendance->attendance_entry_time);
                $isOnTime = $entryTime <= $shiftStartTime; // On Time if entry is before or at the start time
                $isLate = $entryTime > $shiftStartTime->copy()->addMinutes(10); // Late if entry is more than 10 minutes after start time
            } else {
                $isOnTime = false;
                $isLate = false;
            }
        @endphp
        
        <tr>
            <td>{{ $date->toDateString() }}</td>
            <td>{{ $attendance ? $attendance->attendance_entry_time : '-' }}</td>
            <td>
                @if ($attendance)
                    @if ($isOnTime)
                        {{ 'On Time' }}
                    @elseif ($isLate)
                        {{ 'Late' }}
                    @else
                        {{ 'Present' }}  <!-- Default to Present if not late -->
                    @endif
                @else
                    {{ '-' }}
                @endif
            </td>
            <td>{{ $attendance ? ($isOnTime ? 'Present' : 'Absent') : 'Absent' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
