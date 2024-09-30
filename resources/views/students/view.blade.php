@extends('master')

@section('title', 'Student Details')

@section('styles')
<style>

      /********************************* Student Register Form **********************************/
      
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
      .form-group input {
        width: 400px;
      }
      .add-student-form select {
        width: 420px;
      }




      /* ---------------student list box -----------------  */


      .student-list {
        height:300px;
         
            overflow-y: scroll;
            padding: 20px; 
            border: 1px solid #ddd;
            border-radius: 5px; 
        }
     
        .student-actions {
            display: flex;
            gap: 10px;
        }
        .student-box-container {
        margin: 30px 70px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        
      }
      .student-box {
        height: 60px;
        min-width: 600px;
        padding: 10px 30px;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        margin: 10px;
        justify-content: space-between;
        align-items: center;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      }
      .student-detail-list{
      
        margin: 30px 70px 0px 70px;
   
     
      }

      .form-action-btn{
       display: flex;
       justify-content: space-around;
      }
  
  
    /* ----------------view css---------------- */
   .modal {
        display: ;
        position: fixed;
        z-index: 1000; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); 
    }

      /*  .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 10px;
        width: 50%;
        position: relative;
      }

      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
      }

      .close {
        font-size: 24px;
        cursor: pointer;
      }

      .details-grid {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
      }

      .details-grid .left,
      .details-grid .right {
        width: 45%;
      }

      .nfc-center {
        text-align: center;
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: bold;
      } */



      

        .modal-content {
            background-color: #fff;
            margin: 14% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .modal-header h3 {
            margin: 0;
        }

        .modal-header .close-btn,
        .modal-header .edit-btn {
            background: none;
            border: none;
         
            cursor: pointer;
        }

        .modal-header .edit-btn {
            color: #28a745; /* Preferable color for edit button */
            font-size: 1.6rem;
        }

        .modal-header .close-btn {
            color: #dc3545; /* Preferable color for close button */
            font-size: 2.5rem;
        }

        .modal-header .edit-btn:hover {
            color: #218838; /* Darker shade for hover */
        }

        .modal-header .close-btn:hover {
            color: #c82333; /* Darker shade for hover */
        }
.action-btn{
    display: flex;
    align-items: center;
    gap: 10px;
}
        .details-grid {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .details-grid .left,
        .details-grid .right {
            width: 47%;
        }
        .details-grid .left {
            margin: 0 5%;
        }

        .nfc-center {
            text-align: center;
            font-size: 22px;
            margin: 15px 0px;
            font-weight: bold;
        }

        .student-details-box p {
            margin: 15px 0;
        }

        .student-details-box strong {
            font-weight: bold;
        }

        .student-details-box span {
            color: #555;
        }

  </style>



@section('content')


<div id="student-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Student Details</h3>
        <div class="action-btn">
        <button type="button" class="edit-btn" onclick="window.location.href='{{ route('students.edit', $student->student_nfc_id) }}'">
            <i class="fa fa-edit"></i> Edit
        </button>
        <button type="button" class="close-btn" onclick="window.location.href='{{ route('students.index') }}'" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
      </div>
      <div class="student-details-box">
        <div class="nfc-center">
          <strong id="nfc-id">NFC ID : {{ $student->student_nfc_id }}</strong>
        </div>
        <div class="details-grid">
            <div class="left">
                <p><strong>Name:</strong> <span id="modal-name">{{ $student->student_name }}</span></p>
                <p><strong>Date of Birth:</strong> <span id="modal-dob">{{ $student->student_dob }}</span></p>
                <p><strong>Address:</strong> <span id="modal-address">{{ $student->student_address }}</span></p>
                <p><strong>Mobile:</strong> <span id="modal-mobile">{{ $student->student_contact }}</span></p>
                <p><strong>Guardian Phone:</strong> <span id="modal-guardian-phone">{{ $student->student_guardian_phno }}</span></p>
            </div>
            <div class="right">
                <p><strong>Roll No:</strong> <span id="modal-roll">{{ $student->student_rollno }}</span></p>
                <p><strong>Faculty:</strong> <span id="modal-faculty">{{ $faculty->faculty_name}}</span></p>
                <p><strong>Semester:</strong> <span id="modal-semester">{{ $student->student_semester }}</span></p>
                <p><strong>Section:</strong> <span id="modal-section">{{ $student->student_section }}</span></p>
                <p><strong>Shift:</strong> <span id="modal-shift">{{ $shift->shift_name }} ({{ $shift->shift_start_time }} - {{ $shift->shift_end_time }})</span></p>
            </div>
        </div>
      </div>
    </div>
  </div>




{{-- --------------background view ----------------- --}}

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
    </div>
    <div class="student-detail-list" id="student-detail-list">
      <div class="student-heading">
        <h2>Student Details:</h2>
      </div>

      <!-- Example Student Box -->
      <div class="student-list">
        @include('students.partials.student_list', ['students' => $students])
    </div>
  </div>
</div>
@endsection



<script>
  function editStudent(nfcId) {
      // Create a form element dynamically
      let form = document.createElement('form');
      form.method = 'POST';
      form.action = '{{ route("students.edit") }}'; // This route should handle the NFC ID and return the populated form
  
      // Add CSRF token to the form
      let csrfField = document.createElement('input');
      csrfField.type = 'hidden';
      csrfField.name = '_token';
      csrfField.value = '{{ csrf_token() }}';
      form.appendChild(csrfField);
  
      // Add NFC ID to the form
      let nfcField = document.createElement('input');
      nfcField.type = 'hidden';
      nfcField.name = 'student_nfc_id';
      nfcField.value = nfcId;
      form.appendChild(nfcField);
  
      // Append the form to the body and submit it
      document.body.appendChild(form);
      form.submit();
  }
  </script>
  