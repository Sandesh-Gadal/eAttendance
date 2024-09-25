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



@endsection
