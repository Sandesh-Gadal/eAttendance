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
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 4px;
           
        }
        .shift-table {
            width: auto;
            margin-top: 20px;
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
    </style>
@endsection

@section('content')
<div id="shift-content" class="dashboard-content">
    <h2>Manage Shifts</h2>
    <form action="{{ route('shift.storeOrUpdateOrDelete') }}" method="POST" class="shift-form-container" id="shift-form">
        @csrf
        <input type="hidden" id="shift-id" name="shift_id" value="" /> <!-- Hidden field for Shift ID -->
        <input type="hidden" id="form-action" name="action" value="store" /> <!-- Hidden action field -->

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
                            <button class="action-btn update"
                                onclick="populateForm('{{ $shift->shift_id }}', '{{ $shift->shift_name }}', '{{ $shift->shift_start_time }}', '{{ $shift->shift_end_time }}')">
                                Update
                            </button>

                            <button class="action-btn delete" onclick="deleteShift('{{ $shift->shift_id }}')">
                                Delete
                            </button>
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
        document.getElementById('shift-name').value = shiftName;
        document.getElementById('start-time').value = startTime;
        document.getElementById('end-time').value = endTime;
        document.getElementById('shift-id').value = shiftId;

        document.querySelector('.add-btn').innerText = 'Update';
        document.getElementById('form-action').value = 'update';
    }

    function deleteShift(shiftId) {
        if (confirm('Are you sure you want to delete this shift?')) {
            document.getElementById('shift-id').value = shiftId;
            document.getElementById('form-action').value = 'delete';

            document.getElementById('shift-form').submit();
        }
    }
</script>
@endsection
