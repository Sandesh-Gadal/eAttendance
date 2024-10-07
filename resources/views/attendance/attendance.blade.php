@extends('master')

@section('title', 'Attendance Management')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <style>
        #attendance-content h2 {
            margin-left: 70px;
            color: #333;
        }

        .attendance-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            padding: 0 70px;
        }

        .search-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-area label {
            font-weight: bold;
        }

        .search-area input[type="text"] {
            padding: 10px;
            background-color: #eeeeee;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 400px;
            margin-left: 30px;
        }

        .search-btn {
            background-color: #316cec;
            color: white;
            font-weight: bold;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #204ba9;
        }

        .date-download {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .date-download input[type="date"] {
            padding: 10px;
            background-color: #eeeeee;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .download-btn {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .download-btn:hover {
            background-color: #218838;
        }

        .filters-container {
            display: flex;
            justify-content: start;
            gap: 20px;
            margin-top: 20px;
            margin-left: 100px;
            margin-right: 70px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select {
            padding: 10px;
            background-color: #eeeeee;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .attendance-table {
            margin: 20px 100px;
            width: 90%;
            border-collapse: collapse;
        }

        .attendance-table th, .attendance-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .attendance-table th {
            background-color: #eeeeee;
            font-weight: bold;
        }

        .attendance-table th:nth-child(2) {
            color: white;
            background-color: #7f61ca;
        }

        .attendance-table td:nth-child(2) {
            background-color: #b3a6e0;
        }

        .individual-attendance-table-container , .faculty-attendance-table-container  {
            overflow-x: hidden;
            overflow-y: auto;
            height: 50vh;
        }

        #null-message {
            margin-left: 100px;
            color: #333;
        }

        .student-box , .faculty-box{
            display: flex;
            margin-left: 100px;
            padding-left: 20px;
            gap: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .faculty-attendance-table-container {
            display: none; /* Hide by default */
        }
    </style>
@endsection

@section('content')
    <div id="attendance-content" class="dashboard-content">
        <h2>Search by:</h2>
        <div class="attendance-container">
            <div class="search-area">
                <form action="{{ route('attendance.search') }}" method="POST">
                    @csrf
                    <input type="text" name="student_nfc_id" placeholder="Enter Student ID" required>
                    <button class="search-btn">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>

            <div class="date-download">
                <input type="date" id="attendance-date" />
                <button class="download-btn">
                    <i class="fa-solid fa-download"></i> Download
                </button>
            </div>
        </div>

        <div class="filters-container">
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester">
                    <option value="">Select Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>

            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section">
                    <option value="">Select Section</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>

            <div class="form-group">
                <label for="faculty">Faculty:</label>
                <select id="faculty">
                    <option value="" disabled selected>Select Faculty</option>
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->faculty_id }}">{{ $faculty->faculty_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="duration">Duration:</label>
                <select id="duration" name="duration">
                    <option value="30" {{ $duration == 30 ? 'selected' : '' }}>30 Days</option>
                    <option value="15" {{ $duration == 15 ? 'selected' : '' }}>15 Days</option>
                    <option value="7" {{ $duration == 7 ? 'selected' : '' }}>7 Days</option>
                    <option value="1" {{ $duration == 1 ? 'selected' : '' }}>1 Day</option>
                </select>
            </div>
        </div>

        <h2>Attendance Details</h2>
        <div class="individual-attendance-table-container" id="individualAttendanceContainer">
            @if(isset($student))
                <input type="hidden" id="student_id_hidden" value="{{ $student->student_nfc_id }}">
                @include('attendance.partials.individual_student', ['student' => $student, 'attendances' => $attendances ?? []])
            @else
                <p id="null-message">Nothing to show. Please enter a Student ID to search.</p>
            @endif
        </div>

        <div class="faculty-attendance-table-container" id="facultyAttendanceContainer">
            @if(isset($faculty))
                @include('attendance.partials.faculty_attendance', ['faculty' => $faculty, 'attendances' => $attendances ?? []])
            @else
                <p id="null-message">No attendance records found for the selected duration.</p>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('duration').addEventListener('change', function() {
            updateAttendance();
        });

        document.getElementById('faculty').addEventListener('change', function() {
            updateAttendance();
        });

        function updateAttendance() {
            const duration = document.getElementById('duration').value;
            const studentId = document.getElementById('student_id_hidden') ? document.getElementById('student_id_hidden').value : null;
            const facultyId = document.getElementById('faculty') ? document.getElementById('faculty').value : null;

            if (facultyId) {
                // Hide the individual attendance container and show the faculty attendance container
                document.getElementById('individualAttendanceContainer').style.display = 'none';
                document.getElementById('facultyAttendanceContainer').style.display = 'block';

                fetch(`{{ route('attendance.faculty') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ duration: duration, facultyId: facultyId })
                })
                .then(response => response.text())
                .then(data => {
                    document.querySelector('.faculty-attendance-table-container').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            } else if (studentId) {
                // Show the individual attendance container and hide the faculty attendance container
                document.getElementById('individualAttendanceContainer').style.display = 'block';
                document.getElementById('facultyAttendanceContainer').style.display = 'none';

                fetch(`{{ route('attendance.duration') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ duration: duration, student_id_hidden: studentId })
                })
                .then(response => response.text())
                .then(data => {
                    document.querySelector('.individual-attendance-table-container').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            } else {
                console.log("Neither student ID nor faculty ID is set. Not updating the table.");
            }
        }
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('faculty').addEventListener('change', function() {
    //      updateFacultyAttendance();
    //      const facultyId = document.getElementById('faculty') ? document.getElementById('faculty').value : null;

           
    //         if (facultyId) {
    //             // Hide the individual attendance container and show the faculty attendance container
    //             document.getElementById('individualAttendanceContainer').style.display = 'none';
    //             document.getElementById('facultyAttendanceContainer').style.display = 'block';

    //             updateFacultyAttendance();
    //         } else {
    //             // If no faculty is selected, show individual attendance again
    //             document.getElementById('individualAttendanceContainer').style.display = 'block';
    //             document.getElementById('facultyAttendanceContainer').style.display = 'none';
    //         }
    //     });

    //     function updateFacultyAttendance() {
    //         const facultyId = document.getElementById('faculty') ? document.getElementById('faculty').value : null;
    //         const duration = document.getElementById('duration').value;


    //         if (!facultyId) {
    //             console.log("faculty is not set. Not updating the table.");
    //             return;
    //         }
       
    //         fetch(`{{ route('attendance.faculty') }}`, {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             },
    //             body: JSON.stringify({ duration: duration, facultyId: facultyId })
    //         })
    //             .then(response => response.text())
    //         .then(data => {
    //             document.querySelector('.faculty-attendance-table-container').innerHTML = data;
    //         })
    //         .catch(error => console.error('Error:', error));
    //     }
    // });
</script>
@endsection
