@extends('master')

@section('title', 'Dashboard')

@section('styles') 
<style>
 main {
    width: 100%;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .dashboard-content {
    display: block;
  }

  .stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 20px;
    margin-bottom: 20px;
  }

  .stat-item {
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    font-size: 18px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .stat-item span {
    font-size: 48px;
    color: #316cec;
    display: block;
    margin-top: 10px;
  }

  .chart-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 10px;
  }

  .chart {
    width: 46%;
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  #pieChart {
    max-width: 300px; /* Set maximum width for the pie chart */
    margin: 0 auto; /* Center the pie chart */
  }
  h3{
    text-align: center;
  }
</style>
@endsection

@section('content') 
<main>
  <div id="dashboard-content" class="dashboard-content active">
    <div class="stats">
      <div class="stat-item">Total Students: <span>{{ $chartData['totalStudents'] }}</span></div>
      <div class="stat-item">Present | Today: <span>{{ $chartData['presentCount'] }}</span></div>
      <div class="stat-item">Absent | Today: <span>{{ $chartData['absentCount'] }}</span></div>
    </div>

    <div class="chart-container">
      <div class="chart">
        <h3>Attendance Line Chart (Last 30 Days)</h3>
        <canvas id="lineChart"></canvas>
      </div>

      <div class="chart">
        <h3>Attendance Pie Chart</h3>
        <canvas id="pieChart"></canvas>
      </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Line Chart
  const lineCtx = document.getElementById("lineChart").getContext("2d");
  const lineChart = new Chart(lineCtx, {
    type: "line",
    data: {
      labels: @json($chartData['attendanceData']['labels']),
      datasets: [
        {
          label: 'Present',
          data: @json($chartData['attendanceData']['presentData']),
          borderColor: '#4CAF50', // Green for present
          backgroundColor: 'rgba(76, 175, 80, 0.2)',
          fill: true,
        },
        {
          label: 'Absent',
          data: @json($chartData['attendanceData']['absentData']),
          borderColor: '#FF5733', // Red for absent
          backgroundColor: 'rgba(255, 87, 51, 0.2)',
          fill: true,
        },
      ]
    },
    options: {
      plugins: {
        legend: {
          display: true,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  // Pie Chart
  const pieCtx = document.getElementById("pieChart").getContext("2d");
  const pieChart = new Chart(pieCtx, {
    type: "pie",
    data: {
      labels: ['Present', 'Absent'],
      datasets: [
        {
          label: "Attendance",
          data: [
            @json($chartData['presentCount']),
            @json($chartData['absentCount']),
          ],
          backgroundColor: ["#4CAF50", "#FF5733"],
          borderColor: ["#ffffff", "#ffffff"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      animation: {
        animateRotate: true,
        animateScale: true,
      },
      plugins: {
        legend: {
          display: true,
        },
      },
    },
  });
</script>
@endsection
