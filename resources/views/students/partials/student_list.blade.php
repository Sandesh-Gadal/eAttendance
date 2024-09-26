@foreach ($students as $student)
    <div class="student-box">
        <div class="student-details">
            <div class="student-info">
                <h3>Name: {{ $student->student_name }}</h3>
                <p>{{ $student->faculty ? $student->faculty->faculty_name : 'No Faculty Assigned' }} &ensp;{{ $student->student_semester }} Sem &ensp;'{{ $student->student_section }}' &ensp;{{ $student->shift ? $student->shift->shift_name : 'No Shift Assigned' }}</p>
            </div>
            <div class="nfc-id">
                <strong>NFC ID: {{$student->student_nfc_id}}</strong>
            </div>
            <div class="student-actions">
                <button class="view-btn" onclick="window.location.href='{{ route('students.show', $student->student_nfc_id) }}'">
                    <i class="fa-regular fa-eye"></i> View
                </button>
                <button class="delete-btn" onclick="handleDelete('{{ $student->student_nfc_id }}')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
@endforeach
