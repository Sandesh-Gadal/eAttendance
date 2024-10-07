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
 

    <!---------------------------- Faculty Table ---------------------------->
    <div class="faculty-list-filter ">
      <h2>Faculty Details:</h2> 
  </div>
  <table class="faculty-table">
    <thead>
        <tr>
            <th>Faculty Name</th>
            <th>Total Semesters</th>
            <th>Total Students</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($faculties as $faculty)
      <tr>
        <td>{{ $faculty->faculty_name }}</td>
        <td>{{ $faculty->total_semesters }}</td>
        <td>{{ $faculty->total_students }}</td>
      </tr>
  @endforeach
    </tbody>
</table>



@endsection


@section('scripts')
<script>

</script>
@endsection
