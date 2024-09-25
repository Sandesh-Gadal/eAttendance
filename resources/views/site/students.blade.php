@extends('master') <!-- Update this line to match your master layout path -->

@section('title', 'Student Management')

@section('styles')
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
      /********************************* Student Register Form **********************************/
      .student-box-container {
        margin: 30px 70px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
      }
      .student-heading h2 {
        margin-top: -10px;
        margin-bottom: -10px;
        margin-right: 800px;
      }
      .student-box {
        height: 60px;
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      }
      .student-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
      }
      .student-info {
        display: flex;
        flex-direction: column;
      }
      .student-info h3 {
        margin-bottom: -8px;
      }
      .nfc-id {
        font-weight: bold;
      }
      .student-actions {
        display: flex;
        gap: 10px;
      }
      .view-btn,
      .delete-btn {
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        color: white;
        border-radius: 5px;
        font-size: 14px;
      }
      .view-btn {
        background-color: #28a745;
      }
      .delete-btn {
        background-color: #dc3545;
      }
      .filtersofstudent {
        margin-top: 40px;
        margin-left: -60px;
      }
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
      }
      .register-btn:hover {
        background-color: #204ba9;
      }
      .back-btn {
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
      }
      .search-action-container {
        display: flex;
        gap: 50px;
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
      .form-group input {
        width: 400px;
      }
      .add-student-form select {
        width: 420px;
      }
    </style>
@endsection

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
          <button class="btn-add" onclick="showAddStudentForm()">
            <i class="fa fa-plus"></i> Add Student
          </button>
          <button class="btn-delete">
            <i class="fa fa-trash"></i> Delete Student
          </button>
        </div>
      </div>

      <div id="student-boxes" class="student-box-container">
        <div class="filters-heading">
          <h2>Filters:</h2>
        </div>
        <div class="filtersofstudent">
          <div class="form-container">
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
          </div>
        </div>
        <div class="student-heading">
          <h2>Student Details:</h2>
        </div>

        <!-- Example Student Box -->
        <div class="student-box">
          <div class="student-details">
            <div class="student-info">
              <h3>Sandesh Gadal</h3>
              <p>BCA 6th Sem 'A' Shift</p>
            </div>
            <div class="nfc-id">
              <strong>NFC ID: 00123456789</strong>
            </div>
            <div class="student-actions">
              <button class="view-btn">
                <i class="fa-regular fa-eye"></i> View
              </button>
              <button class="delete-btn">
                <i class="fa fa-trash"></i> Delete
              </button>
            </div>
          </div>
        </div>

        <div class="student-box">
          <div class="student-details">
            <div class="student-info">
              <h3>Abina Bishokarma</h3>
              <p>BCA 6th Sem 'A' Shift</p>
            </div>
            <div class="nfc-id">
              <strong>NFC ID: 00234567890</strong>
            </div>
            <div class="student-actions">
              <button class="view-btn">
                <i class="fa-regular fa-eye"></i> View
              </button>
              <button class="delete-btn">
                <i class="fa fa-trash"></i> Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      <div id="add-student-form" class="add-student-form" style="display: none">
        <h2>Add Student</h2>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <div class="form-container">
                <div class="form-left">
                    <div class="form-group">
                        <label for="student-id">Student ID:</label>
                        <input type="text" id="student-id" name="student_nfc_id" placeholder="Enter Student ID" />
                    </div>
                    <div class="form-group">
                        <label for="roll-no">Roll No:</label>
                        <input type="text" id="roll-no" name="student_rollno" placeholder="Enter Roll No" />
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="student_dob" />
                    </div>
                    <div class="form-group">
                        <label for="faculty-id">Faculty:</label>
                        <select id="faculty-id" name="faculty_id">
                          <option value="" disabled selected>Select Faculty</option>
                          @foreach($faculties as $faculty)
                              <option value="{{ $faculty->faculty_id }}">{{ $faculty->faculty_name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester:</label>
                        <select id="semester" name="student_semester">
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
                        <select id="shift-id" name="shift_id">
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
                        <input type="text" id="full-name" name="student_name" placeholder="Enter Full Name" />
                    </div>
                    <div class="form-group">
                        <label for="section">Section:</label>
                        <select id="section" name="student_section">
                            <option value="">Select Section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Student Phone No:</label>
                        <input type="text" id="phone" name="student_contact" placeholder="Enter Phone No" />
                    </div>
                    <div class="form-group">
                        <label for="guardian-phone">Guardian Phone No:</label>
                        <input type="text" id="guardian-phone" name="student_guardian_phno" placeholder="Enter Guardian Phone No" />
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="student_address" placeholder="Enter Address" />
                    </div>
                </div>
            </div>
            <button type="submit" class="register-btn" onclick="submit()">
                Register
            </button>
            <button type="button" class="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </form>
    </div>
    
    </div>

    <script>
      function showAddStudentForm() {
        document.getElementById("student-boxes").style.display = "none";
        document.getElementById("add-student-form").style.display = "block";
      }

      function registerStudent() {
       
    
        document.getElementById("add-student-form").style.display = "none";
        document.getElementById("student-boxes").style.display = "flex";
      }

      function goBack() {
        document.getElementById("add-student-form").style.display = "none";
        document.getElementById("student-boxes").style.display = "flex";
      }
    </script>
@endsection
