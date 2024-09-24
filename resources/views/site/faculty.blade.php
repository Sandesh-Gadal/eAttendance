@extends('master') <!-- Adjust to match your master layout path -->

@section('title', 'Faculty Management')

@section('styles')
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
        /********************************** General Layout ***********************************/
/********************************** Faculty Section ***********************************/
#faculty-content h2, 
h2 {
  margin-left: 40px; Align headers to the left
  text-align: left; /* Ensure left alignment */
}

#faculty-content{

}

.form-container {
  display: flex;
  /* justify-content: space-between; */
  margin: 20px 0;
}

.form-group {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
  /* width: 100%; */
}

.form-group label,
input,
select {
  margin-left: 50px;
}

.form-group label {
  display: block; /* Ensure label is on its own line */
  margin-bottom: 5px; /* Space between label and input */
}

#faculty-name {
  width: 400px; /* Input field width */
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #f9f9f9;
}

.form-container #total-students {
  width: 400px;
}

.facultyadddelbutton {
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Align buttons to the left */
  gap: 20px; /* Uniform gap between buttons */
  margin-left: 100px; /* Align with the form */
}

.facultyadddelbutton .btn-add,
.facultyadddelbutton .btn-delete {
  width: 140px;
  color: white;
  font-weight: bold;
  padding: 10px 25px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.facultyadddelbutton .btn-add {
  background-color: #316cec; /* Add button color */
}

.facultyadddelbutton .btn-delete {
  background-color: #dc3545; /* Delete button color */
}

.facultyadddelbutton button:hover {
  opacity: 0.9; /* Button hover effect */
}

/********************************** Faculty Table ***********************************/
   .faculty-table {
        width: 60%;
        margin-left: 100px;
        border-collapse: collapse;
      }

      .faculty-table th,
      .faculty-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
      }

      .faculty-table th {
        background-color: #eeeeee;
        font-weight: bold;
      }

      .faculty-table tr:nth-child(even) {
        background-color: #f9f9f9;
      }

/********************************* Add Number of Students **********************************/
.form-group select,
#total-students {
  width: 420px;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #f9f9f9;
}

.register-btn {
  width: 140px;
  background-color: #316cec;
  color: white;
  font-weight: bold;
  padding: 10px 25px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
  display: block;
  margin: 20px auto;
}

.register-btn:hover {
  background-color: #204ba9;
}

    </style>
@endsection

@section('content')
    <!---------------------------- Faculty Form ------------------------------------>
    <form action="{{ route('faculty.store') }}" method="POST">
        @csrf
        <div id="faculty-content">
            <h2>Add Faculty</h2>
            <div class="form-container">
                <div class="form-group">
                    <label for="faculty-name">Faculty Name:</label>
                    <input
                        type="text"
                        id="faculty-name"
                        name="faculty_name"
                        placeholder="Enter Faculty Name"
                        required
                    />
                </div>
                <div class="facultyadddelbutton">
                    <button class="btn-add" type="submit"><i class="fa fa-plus"></i> Add</button>
                    <button class="btn-delete" type="button">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </form>
  
    <!------------------------- Add Number of Students Form ------------------------->
    <form action="{{ route('student_count.store') }}" method="POST">
        @csrf
        <h2>Add Number of Students</h2>
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="faculty">Select Faculty</label>
                    <select name="faculty_id" id="faculty" required>
                        <option value="" disabled selected>Select Faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->faculty_id }}">{{ $faculty->faculty_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="section" required>
                        <option value="" disabled selected>Select Section</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                    </select>
                </div>
            </div>
            <div class="form-right">
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select id="semester" name="semester_level" required>
                        <option value="" disabled selected>Select Semester</option>
                        @for($i = 1; $i <= 9; $i++)
                            <option value="{{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="total-students">Total Students:</label>
                    <input
                        type="number"
                        id="total-students"
                        name="student_number"
                        placeholder="Enter Total Students"
                        required
                    />
                </div>
            </div>
        </div>
        <button class="register-btn" type="submit">Add</button>
    </form>

    <!---------------------------- Faculty Table ---------------------------->
    <h2>Faculty List</h2>
    <table class="faculty-table">
        <thead>
            <tr>
                <th>Faculty</th>
                <th>Total Semester</th>
                <th>Total Students</th>
                <th>Registered Students</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facultyData as $faculty)
                <tr>
                    <td>{{ $faculty->faculty_name }}</td>
                    <td>{{ $faculty->studentCounts->sum('total_semesters') ?? 0 }}</td>
                    <td>{{ $faculty->studentCounts->sum('total_students') ?? 0 }}</td>
                    <td>{{ $faculty->registered_students }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
