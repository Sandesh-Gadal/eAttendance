@extends('master') <!-- Adjust this to match your master layout path -->

@section('title', 'Attendance Management')

@section('styles')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
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

        /* Filters */
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

        /* Attendance Table */
        .attendance-table {
            margin: 20px 100px;
            width: 90%;
            border-collapse: collapse;
        }

        .attendance-table th,
        .attendance-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .attendance-table th {
            background-color: #eeeeee;
            font-weight: bold;
        }

        /* Specific styling for Student Name header */
        .attendance-table th:nth-child(2) {
            color: white;
            background-color: #7f61ca; /* Purple highlight for the header */
        }

        /* Styling for Student Name column data */
        .attendance-table td:nth-child(2) {
            background-color: #b3a6e0;
        }
    </style>
@endsection

@section('content')
    <!----------------------------Attendance------------------------------------>
    <div id="attendance-content" class="dashboard-content">
        <h2>Search by:</h2>
        <div class="attendance-container">
            <!-- Search Area -->
            <div class="search-area">
                <input
                    type="text"
                    id="search"
                    placeholder="Enter search term"
                />
                <button class="search-btn"> 
                    <i class="fas fa-search"></i> Search
                </button>
            </div>

            <!-- Date Selector and Download -->
            <div class="date-download">
                <input type="date" id="attendance-date" />
                <button class="download-btn">
                    <i class="fa-solid fa-download"></i> Download
                </button>
            </div>
        </div>

        <!-- Filter Options -->
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
                <select id="duration">
                    <option value="">Select Duration</option>
                    <option value="One Day">One Day</option>
                    <option value="One Week">One Week</option>
                    <option value="One Month">One Month</option>
                </select>
            </div>
        </div>

        <h2>Attendance Details</h2>
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>Student NFC ID</th>
                    <th>Student Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Remarks</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>001</td>
                    <td>Ram Tamang</td>
                    <td>2024-09-01</td>
                    <td>6:00 AM</td>
                    <td>On Time</td>
                    <td>Present</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Sandesh Gadal</td>
                    <td>2024-09-01</td>
                    <td>6:10 AM</td>
                    <td>On Time</td>
                    <td>Present</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Abina Bishokarma</td>
                    <td>2024-09-01</td>
                    <td>6:05 AM</td>
                    <td>On Time</td>
                    <td>Present</td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>
    </div>
    <!----------------------------Attendance End------------------------------------>
@endsection
