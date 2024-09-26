@extends('master') <!-- Update this line to match your master layout path -->

@section('title', 'Student Management')

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
            /* max-height: calc(100vh - 100px);  */
            overflow-y: scroll; /* Enable vertical scrolling */
            padding: 20px; /* Optional padding */
            border: 1px solid #ddd; /* Optional border for better visibility */
            border-radius: 5px; /* Optional rounded corners */
        }
     
        .student-actions {
            display: flex;
            gap: 10px; /* Space between buttons */
        }
        .student-box-container {
        margin: 30px 70px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        
      }
      /* .student-heading h2 {
        margin-top: -10px;
        margin-bottom: -10px;
        margin-right: 800px;
      } */
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
  
    </style>
@endsection

@section('content')
<div id="students-content">
  <div class="search-action-container">
    <form id="search-form" method="POST" action="{{ route('students.search') }}">
      @csrf
      <div class="search-area">
          <input type="text" name="query" id="search-input" placeholder="Search students..." />
          <button type="submit" class="search-btn">
              <i class="fas fa-search"></i> Search
          </button>
      </div>
  </form>
  
      
      <div class="action-buttons">
        <button class="btn-add" onclick="window.location.href='{{ route('students.create') }}'">
          <i class="fa fa-plus"></i> Add Student
        </button>
      </div>
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
      


   

@endsection


@section('scripts')
<script>
  let timeout;

document.getElementById('search-input').addEventListener('keyup', function() {
    // Clear the timeout if the user types again
    clearTimeout(timeout);

    // Set a new timeout to submit the form after 500 milliseconds
    timeout = setTimeout(function() {
        document.getElementById('search-form').submit();
    }, 500); // Adjust the interval here (in milliseconds)
});
</script>

@endsection