@extends('master') <!-- Adjust this to match your master layout path -->

@section('title', 'Device Settings')

@section('styles')
    <style>
        #device-settings-content h2 {
            margin-left: 70px;
            color: #333;
        }

        .devicesettings {
            display: flex;
            justify-content: space-between;
            margin: 20px 100px;
        }

        .devicesettings .form-group {
            flex: 1;
            margin-right: 20px;
        }

        .devicesettings .form-group:last-child {
            margin-right: 0;
        }

        .devicesettings label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .devicesettings input {
            width: 400px;
            padding: 10px;
            background-color: #eeeeee;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #deivce-location {
            margin-left: -100px;
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
            margin-left: 480px;
        }

        .add-btn:hover {
            background-color: #204ba9;
        }

        .device-table {
            margin-left: 100px;
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .device-table th,
        .device-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .device-table th {
            background-color: #eeeeee;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!----------------------------Device Settings------------------------------------>
    <div id="device-settings-content">
        <h2>Device Settings</h2>
        <div class="devicesettings">
            <div class="form-group">
                <label for="device-id">Device ID:</label>
                <input type="text" id="device-id" placeholder="Device ID here" />
            </div>
            <div class="form-group">
                <label for="device-location">Device Location:</label>
                <input type="text" id="deivce-location" placeholder="Enter the location" />
            </div>
        </div>
        <button class="add-btn">Add</button>

        <h2>Device List</h2>
        <table class="device-table">
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>XXXX-XXXX-XXXX</td>
                    <td>BCA Block</td>
                </tr>
                <tr>
                    <td>XXXX-XXXX-XXXX</td>
                    <td>BE Block</td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>
    </div>
    <!----------------------------Device Settings End------------------------------------>
@endsection
