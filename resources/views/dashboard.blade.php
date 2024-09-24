@extends('master')

@section('title', 'Dashboard')

@section('styles') <!-- Dashboard-specific styles -->
<style>
  main {
    flex: 1;
    padding: 20px;
    background-color: #ffffff;
    overflow-y: auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .dashboard-content {
    display: none;
  }

  .dashboard-content.active {
    display: block;
  }

  .stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .stats .stat-item {
    flex: 1;
    padding: 20px;
    margin-right: 20px;
    background-color: #f7f7f7;
    border-radius: 8px;
    text-align: center;
    font-size: 18px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .stats .stat-item:last-child {
    margin-right: 0;
  }

  .recent-activities {
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-size: 18px;
  }
</style>
@endsection

@section('content') <!-- Dashboard content -->
<div id="dashboard-content" class="dashboard-content active">
  <div class="stats">
    <div class="stat-item">Total Students: 654</div>
    <div class="stat-item">Present | Today: 554</div>
    <div class="stat-item">Absent | Today: 100</div>
  </div>
  <div class="recent-activities">
    <h2>Recent Activities</h2>
    <p>Activity 1: Updated student records</p>
    <p>Activity 2: Scheduled new shifts</p>
    <p>Activity 3: Added holiday schedule</p>
    <!-- Add more activities as needed -->
  </div>
</div>
@endsection
