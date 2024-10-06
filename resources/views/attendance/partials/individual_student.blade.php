@if($student)
<div class="student-box">
    <p><strong>Name: &ensp;{{ $student->student_name }}</strong></p>
    <p><strong>NFC ID: &ensp;{{ $student->student_nfc_id }}</strong></p>
</div>
@endif
<input type="hidden" id="student_id_hidden" value="{{ $student ? $student->student_nfc_id : '' }}">
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
            $dates = [];
            $startDate = now()->subDays($duration)->startOfDay();
            $endDate = now()->endOfDay();
            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $dates[] = $date->copy();
            }
        @endphp
        
        @foreach ($dates as $date)
        @php
            $attendance = $attendances->where('attendance_date', $date->toDateString())->first();
            $shiftStartTime = $shift ? Carbon\Carbon::parse($shift->shift_start_time) : null;

            $entryTime = null;
            $remarks = '-';
            $attendanceStatus = 'Absent'; // Default to Absent

            if ($attendance) {
                $entryTime = Carbon\Carbon::parse($attendance->attendance_entry_time);

                if ($entryTime < $shiftStartTime->copy()->subMinutes(10)) {
                    $remarks = 'Early';
                } elseif ($entryTime >= $shiftStartTime->copy()->subMinutes(10) && $entryTime <= $shiftStartTime->copy()->addMinutes(10)) {
                    $remarks = 'On time';
                } else {
                    $remarks = 'Late';
                }

                $attendanceStatus = 'Present'; // Mark as Present if there's an attendance record
            }
        @endphp
        
        <tr>
            <td>{{ $date->toDateString() }}</td>
            <td>{{ $entryTime ? $entryTime->format('H:i') : '-' }}</td>
            <td>{{ $attendance ? $remarks : '-' }}</td>
            <td>{{ $attendanceStatus }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
