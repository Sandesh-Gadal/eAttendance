@extends('master') <!-- Adjust this to match your master layout path -->

@section('title', 'Shift Management')

@section('styles')
    <style>
        #shift-content {
            margin-left: 70px;
        }
        .time {
            margin-top: 20px;
        }
        #start-time,
        #end-time {
            font-size: 20px;
        }

        .shift-form-container {
            display: flex;
            flex-direction: column;
          max-width: 600px;
          
        }
        #shift-content .shift-input {
            width: 200px;
            padding: 10px;
            background-color: #eeeeee;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #shift-content .time {
            display: flex;
        }

        .form-group {
            display: flex
           jusdify-content: center;
        }
        .shift-table {
            width: auto; /* Adjusted to fit content */
            margin-top: 20px; /* Space above the table */
            border-collapse: collapse;
        }
        .form-group label {
            margin-left: 20px;
        }
        .shift-table th,
        .shift-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            
        }
        .shift-table th {
            background-color: #eeeeee;
            font-weight: bold;
        }
        .add-btn {
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
        .add-btn:hover {
            background-color: #204ba9;
        }
        .action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        /* Update button styles */
        .action-btn.update {
            background-color: #ffa500; /* Orange */
            color: white;
        }
        .action-btn.update:hover {
            background-color: #e68a00; /* Darker orange */
        }
        .action-btn.update:active {
            background-color: #cc8400; /* Even darker orange */
        }
        /* Delete button styles */
        .action-btn.delete {
            background-color: #ff4d4d; /* Red */
            color: white;
        }
        .action-btn.delete:hover {
            background-color: #e60000; /* Darker red */
        }
        .action-btn.delete:active {
            background-color: #cc0000; /* Even darker red */
        }
        .action-button {
            display: grid;
            grid-template-columns: auto auto; 
            gap: 10px;
        }
    </style>
@endsection

@section('content')
<div id="shift-content" class="dashboard-content">
    <h2>Manage Shifts</h2>
    <form action="{{ route('shift.store') }}" method="POST" class="shift-form-container" id="shift-form">
        @csrf
        <input type="hidden" id="shift-id" name="shift_id" value="" /> <!-- Hidden field for Shift ID -->
    
        <div class="form-group">
            <label for="shift-name">Shift Name:</label>
            <input class="shift-input" type="text" id="shift-name" name="shift_name" placeholder="Enter Shift Name" required/>
        </div>
    
        <div class="time">
            <div class="form-group">
                <label for="start-time">Start Time:</label>
                <input type="time" id="start-time" name="shift_start_time" required />
            </div>
            <div class="form-group">
                <label for="end-time">End Time:</label>
                <input type="time" id="end-time" name="shift_end_time" required />
            </div>
        </div>
    
        <button type="submit" class="add-btn">Add Shift</button>
    </form>
    

    <h2>Shift List:</h2>
    <div class="shift-table">
        <table>
            <thead>
                <tr>
                    <th>Shift Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ $shift->shift_name }}</td>
                        <td>{{ $shift->shift_start_time }}</td>
                        <td>{{ $shift->shift_end_time }}</td>
                        <td class="action-button">
                            <button
                                class="action-btn update"
                                onclick="populateForm('{{ $shift->id }}', '{{ $shift->shift_name }}', '{{ $shift->shift_start_time }}', '{{ $shift->shift_end_time }}')">Update</button>
                            <button  class="action-btn delete"onclick="confirmDelete('{{ $shift->id }}')" >Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
 function populateForm(shiftId, shiftName, startTime, endTime) {
    // Populate form fields with shift data
    document.getElementById('shift-name').value = shiftName;
    document.getElementById('start-time').value = startTime;
    document.getElementById('end-time').value = endTime;
    document.getElementById('shift-id').value = shiftId; // Set shift ID in hidden input

    // Change button text to "Update"
    document.querySelector('.add-btn').innerText = 'Update';

    // Update the form's action URL to point to the update route
    const form = document.querySelector('#shift-form');
    form.setAttribute('action', `/shift/${shiftId}`);

    // Add a hidden input to change the method to PUT for updating
    let methodInput = document.createElement('input');
    methodInput.setAttribute('type', 'hidden');
    methodInput.setAttribute('name', '_method');
    methodInput.setAttribute('value', 'PUT');
    
    // Remove existing _method input if already present
    const existingMethodInput = form.querySelector('input[name="_method"]');
    if (existingMethodInput) {
        existingMethodInput.remove();
    }
    form.appendChild(methodInput);
}


function confirmDelete(shiftId) {
    if (confirm('Are you sure you want to delete this shift?')) {
        // Create a form and submit a DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/shift/${shiftId}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

function resetForm() {
    document.getElementById('shift-form').reset();
    document.getElementById('shift-id').value = ''; // Clear hidden shift ID input
    document.querySelector('.add-btn').innerText = 'Add Shift'; // Reset button text
    document.querySelector('#shift-form').setAttribute('action', '/shift'); // Reset action to POST

    // Remove any hidden _method input (for PUT requests)
    const existingMethodInput = document.querySelector('input[name="_method"]');
    if (existingMethodInput) {
        existingMethodInput.remove();
    }
}


</script>
@endsection
