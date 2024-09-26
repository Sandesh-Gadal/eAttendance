@extends('master')

@section('title', 'Student Register')

@section('styles')
<style>
    /********************************* Student Register Form **********************************/
    

    .form-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }
    .form-group {
      margin: 15px 0;
      display: flex;
      flex-direction: column;
    }
    .form-group label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
      padding: 10px;
      background-color: #eeeeee;
      border: 1px solid #ddd;
      border-radius: 4px;
      width: 100%;
    }
    .register-btn {
      background-color: #316cec;
      color: white;
      width: 140px;
      font-weight: bold;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin: 20px auto;
      margin-left: 200px;
    }
    .register-btn:hover {
      background-color: #204ba9;
    }
    .back-btn {
      background-color: #ff7300;
      color: white;
      width: 140px;
      font-weight: bold;
      padding: 10px 25px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin: 20px auto 20px -300px;
    }
    .search-action-container {
      display: flex;
      gap: 150px;
      margin: 20px 70px;
    }
    .search-area {
      display: flex;
      align-items: center;
    }
    .search-area input {
      padding: 10px;
      width: 300px;
      border: 1px solid #ddd;
      border-radius: 4px;
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
      margin-left: 10px;
    }
    .search-btn:hover {
      background-color: #204ba9;
    }
    .action-buttons {
      display: flex;
      gap: 10px;
    }
    .action-buttons button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .btn-add {
      background-color: #28a745;
    }
    .btn-add:hover {
      background-color: #218838;
    }
    .btn-delete {
      background-color: #dc3545;
    }
    .btn-delete:hover {
      background-color: #c82333;
    }
    .add-student-form {
      margin-left: 70px;
    }

    .form-action-btn{
     display: flex;
     justify-content: space-around;
    }

  </style>



@section('content')
<div id="students-content">
<div class="search-action-container">
<div class="search-area">
  <input type="text" placeholder="Search students..." />
  <button class="search-btn">
    <i class="fas fa-search"></i> Search
  </button>
</div>
<div class="action-buttons">
    <button class="btn-add" onclick="window.location.href='{{ route('students.create') }}'">
        <i class="fa fa-plus"></i> Add Student
      </button>
</div>
</div>



<div id="add-student-form" class="add-student-form" >
    <h2>Add Student</h2>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="student-id">Student ID:</label>
                    <input type="text" id="student-id" name="student_nfc_id" placeholder="Enter Student ID" required/>
                </div>
                <div class="form-group">
                    <label for="roll-no">Roll No:</label>
                    <input type="text" id="roll-no" name="student_rollno" placeholder="Enter Roll No" required/>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="student_dob" />
                </div>
                <div class="form-group">
                    <label for="faculty-id">Faculty:</label>
                    <select id="faculty-id" name="faculty_id" required>
                      <option value="" disabled selected>Select Faculty</option>
                      @foreach($faculties as $faculty)
                          <option value="{{ $faculty->faculty_id }}">{{ $faculty->faculty_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select id="semester" name="student_semester" required>
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
                    <label for="shift-id">Shift:</label>
                    <select id="shift-id" name="shift_id" required>
                      <option value=""disabled selected>Select a shift</option>
                      @foreach($shifts as $shift)
                          <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }} ({{ $shift->shift_start_time }} - {{ $shift->shift_end_time }})</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="form-right">
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="student_name" placeholder="Enter Full Name" required/>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="student_section" required>
                        <option value="">Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Student Phone No:</label>
                    <input type="text" id="phone" name="student_contact" placeholder="Enter Phone No" required/>
                </div>
                <div class="form-group">
                    <label for="guardian-phone">Guardian Phone No:</label>
                    <input type="text" id="guardian-phone" name="student_guardian_phno" placeholder="Enter Guardian Phone No" required/>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="student_address" placeholder="Enter Address" required/>
                </div>
            </div>
        </div>
        <div class="form-action-btn">
       <div>
         <button type="submit" class="register-btn" onclick="submit()">
            Register
        </button>
       </div>
        <div>
          <button type="button" class="back-btn" onclick="window.location.href='{{route('students.index')}}'">
            <i class="fas fa-arrow-left"></i> Back
        </button>
        </div>
      </div>
      </form>
</div>
@endsection