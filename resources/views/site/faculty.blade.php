@extends('master') <!-- Adjust to match your master layout path -->

@section('title', 'Faculty Management')

@section('styles')
    <style>
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

.facultyadddelbutton , .facultydeletebutton {
  display: flex;
 justify-content: center;

}

.facultyadddelbutton .btn-add,
.facultydeletebutton .btn-delete {
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

.facultydeletebutton .btn-delete {
  background-color: #dc3545; /* Delete button color */
}

.facultyadddelbutton button:hover {
  opacity: 0.9; /* Button hover effect */
}

/********************************** Faculty Table ***********************************/
   .faculty-table {
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
  width: 400px;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #f9f9f9;
}

.btn-add , .btn-delete{
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

.btn-add:hover {
  background-color: #204ba9;
}

.faculty-list-filter{
  display: flex;  
  justify-content: flex-start;
  align-items: center;
  gap: 50px;
}

.faculty-list-filter select{
  min-width: 200px;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #f9f9f9;
}
.action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
  .action-btn.update {
background-color: #ffa500;
   color: white;
        }
      .action-btn.delete {
            background-color: #ff4d4d;
            color: white;
        }
        .action-button {
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
        }

        .faculty-main {
           display: grid;
           grid-template-columns: auto auto;
           width: 90%;
           gap: 50px;
        }
       
    </style>
@endsection

@section('content')

 <div class="faculty-main">
<form action="{{ route('faculty.store') }}" method="POST" class="add-form">
  @csrf
  <div id="faculty-content" >
      <h2>Add Faculty :</h2>
      <div class="form-add-container">
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
              <button class="btn-add" type="submit">
                  <i class="fa fa-plus"></i> Add
              </button>
          </div>
      </div>
  </div>
</form>

<!-- Delete Faculty Form -->
<form action="{{ route('faculty.delete') }}" method="POST" class="delete-form">
  @csrf
  @method('DELETE') <!-- This ensures the form will send a DELETE request -->
  <div id="faculty-delete">
      <h2>Delete Faculty :</h2>
      <div class="form-delete-container">
          <div class="form-group">
              <label for="faculty-delete-name">Select Faculty to Delete:</label>
              <select id="faculty-delete-name" name="faculty_id" required>
                  <option value="" disabled selected>Select Faculty</option>
                  @foreach($faculties as $faculty)
                      <option value="{{ $faculty->faculty_id }}">{{ $faculty->faculty_name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="facultydeletebutton">
              <button class="btn-delete" type="submit">
                  <i class="fa fa-trash"></i> Delete
              </button>
          </div>
      </div>
  </div>
</form>
</div>
    <!------------------------- Add Number of Students Form ------------------------->
    {{-- <form action="{{ route('studentCount.storeOrUpdateOrDelete') }}" method="POST" id="studentcount-form"> <!-- Change route as needed -->
        @csrf
        <h2>Add Number of Students</h2>
        <input type="hidden" id="student-count-id" name="student_count_id" value="" /> <!-- Hidden field for student count ID -->
        <input type="hidden" id="form-action" name="action" value="store" />

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
                        <option value="A">A</option>
                        <option value="B">B</option>
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
        <button class="btn-add" id="btn-add" type="submit">Add</button>
    </form> --}}

    <!---------------------------- Faculty Table ---------------------------->
    <div class="faculty-list-filter ">
      <h2>Faculty Details:</h2> 
      {{-- <form method="GET" action="{{ route('fetch-faculty-table') }}">
        <select name="faculty_id" id="faculty" required>
            <option value="" disabled selected>Select Faculty</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->faculty_id }}">
                    {{ $faculty->faculty_name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form> --}}
  </div>
  <table class="faculty-table">
    <thead>
        <tr>
            <th>Faculty</th>
            <th>Semester</th>
            <th>Section</th>
            <th>Total Students</th>
            <th>Registered Students</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($studentCounts as $studentCount)
                <tr>
                  <td>{{ $studentCount->faculty ? $studentCount->faculty->faculty_name : 'No Faculty Assigned' }}</td>
                    <td>{{ $studentCount->semester_level }}</td>
                    <td>{{ $studentCount->section }}</td>
                    <td>{{ $studentCount->student_number }}</td>
                    <td>{{ $studentCount->registered_students }}</td>
                    <td class="action-button">
                        <button class="action-btn update"
                            onclick="populateFacultyForm('{{ $studentCount->id }}', '{{ $faculty->faculty_id }}', '{{ $studentCount->section }}', '{{ $studentCount->semester_level }}', '{{ $studentCount->student_number }}')">
                            Update
                        </button>
                        <button class="action-btn delete" onclick="deleteStudentCount('{{ $studentCount->id }}')">
                            Delete
                        </button>
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>


@endsection


@section('scripts')
<script>
    function populateFacultyForm(id, facultyId, section, semester, totalStudents) {
      console.log(id, facultyId, section, semester, totalStudents); 
        document.getElementById('faculty').value = facultyId; // Assuming you have faculty ID in the form
        document.getElementById('section').value = section;
        document.getElementById('semester').value = semester;
        document.getElementById('total-students').value = totalStudents;
        document.getElementById('form-action').value = 'update'; // Update hidden field for the action
        document.getElementById('student-count-id').value =id; // Adjust based on your hidden input for studentCount ID
        document.getElementById('btn-add').innerText = 'Update';
    }

    function deleteStudentCount(id) {
        if (confirm('Are you sure you want to delete this shift?')) {
          console.log(id);
            document.getElementById('student-count-id').value = id;
            document.getElementById('form-action').value = 'delete';
            document.getElementById('studentcount-form').submit();
        }
    }
</script>
@endsection
