@extends('master')

@section('title', 'Student Edit')

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
<div id="add-student-form" class="add-student-form">
    <h2>Edit Student</h2>
    <form method="POST" action="{{ route('students.update', $student->student_nfc_id) }}">
        @csrf
        @method('PUT')
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="student-id">Student ID:</label>
                    <input type="text" id="student-id" name="student_nfc_id" value="{{ $student->student_nfc_id }}"  disabled />
                    <input type="text" id="student-id1" name="student_nfc_id1" value="{{ $student->student_nfc_id }}" hidden/>
                </div>
                <div class="form-group">
                    <label for="roll-no">Roll No:</label>
                    <input type="text" id="roll-no" name="student_rollno" value="{{ $student->student_rollno }}" required/>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="student_dob" value="{{ $student->student_dob }}" />
                </div>
                <div class="form-group">
                    <label for="faculty-id">Faculty:</label>
                    <select id="faculty-id" name="faculty_id" required>
                        <option value="" disabled>Select Faculty</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->faculty_id }}" {{ $faculty->faculty_id == $student->faculty_id ? 'selected' : '' }}>{{ $faculty->faculty_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select id="semester" name="student_semester" required>
                        <option value="">Select Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ $i == $student->student_semester ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="shift-id">Shift:</label>
                    <select id="shift-id" name="shift_id" required>
                        <option value="" disabled>Select a shift</option>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->shift_id }}" {{ $shift->shift_id == $student->shift_id ? 'selected' : '' }}>{{ $shift->shift_name }} ({{ $shift->shift_start_time }} - {{ $shift->shift_end_time }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-right">
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="student_name" value="{{ $student->student_name }}" required/>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="student_section" required>
                        <option value="">Select Section</option>
                        <option value="A" {{ $student->student_section == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $student->student_section == 'B' ? 'selected' : '' }}>B</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Student Phone No:</label>
                    <input type="text" id="phone" name="student_contact" value="{{ $student->student_contact }}" required/>
                </div>
                <div class="form-group">
                    <label for="guardian-phone">Guardian Phone No:</label>
                    <input type="text" id="guardian-phone" name="student_guardian_phno" value="{{ $student->student_guardian_phno }}" required/>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="student_address" value="{{ $student->student_address }}" required/>
                </div>
            </div>
        </div>
        <div class="form-action-btn">
            <div>
                <button type="submit" class="register-btn">Update</button>
            </div>
            <div>
                <button type="button" class="back-btn" onclick="window.location.href='{{ route('students.index') }}'">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
