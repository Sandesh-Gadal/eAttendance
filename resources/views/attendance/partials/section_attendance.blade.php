<div>
    <div class="student-box">
        <p><strong>Faculty: {{ $faculty->faculty_name }}  &ensp; Semester: {{ $semester }} &ensp; Section: {{ $section }}</strong></p>
    </div>
   
    <table class="attendance-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Present</th>
                <th>Absent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendanceSummary as $attendance)
                <tr>
                    <td>{{ $attendance['date'] }}</td>
                    <td>{{ $attendance['present'] }}</td>
                    <td>{{ $attendance['absent'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
