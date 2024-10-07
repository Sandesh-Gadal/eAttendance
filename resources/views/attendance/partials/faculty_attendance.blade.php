@if($faculty)
<div class="faculty-box">
    <p><strong>Faculty: &ensp;{{ $faculty->faculty_name }}</strong></p>
</div>
@endif

<table class="attendance-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Total Present Students</th>
            <th>Total Absent Students</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($attendanceSummary))

    <!-- Display attendance summary -->

    @foreach($attendanceSummary as $summary)

    <tr>
        <td>{{ $summary['date'] }}</td>
        <td>{{ $summary['present'] }}</td>
        <td>{{ $summary['absent'] }}</td>
    </tr>

    @endforeach

@else

    <p>No attendance summary available.</p>

@endif
    </tbody>
</table>
