@extends('master')

@section('title', 'Dashboard')

@section('styles') <!-- Dashboard-specific styles -->
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
</style>
@endsection

@section('content') <!-- Dashboard content -->
<main>
  <div id="dashboard-content" class="dashboard-content active">
    <div class="stats">
      <div class="stat-item">Total Students: <span>654</span></div>
      <div class="stat-item">Present | Today: <span>554</span></div>
      <div class="stat-item">Absent | Today: <span>100</span></div>
    </div>

    <div class="chart-container">
      <div class="chart">
        <h3>Attendance Bar Chart</h3>
        <canvas id="barChart"></canvas>
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
  // Bar Chart
  const barCtx = document.getElementById("barChart").getContext("2d");
  const barChart = new Chart(barCtx, {
    type: "bar",
    data: {
      labels: ["Total Students", "Present", "Absent"],
      datasets: [
        {
          label: "Students",
          data: [654, 554, 100],
          backgroundColor: ["#316CEC", "#4CAF50", "#FF5733"],
          borderColor: ["#316CEC", "#4CAF50", "#FF5733"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      plugins: {
        legend: {
          display: true,
          labels: {
            generateLabels: function (chart) {
              let datasets = chart.data.datasets[0].data;
              return [
                {
                  text: "Total Students: ",
                  fillStyle: "#316CEC",
                },
                { text: "Present: ", fillStyle: "#4CAF50" },
                { text: "Absent: ", fillStyle: "#FF5733" },
              ];
            },
          },
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
      labels: ["Present", "Absent"],
      datasets: [
        {
          label: "Attendance",
          data: [554, 100],
          backgroundColor: ["#4CAF50", "#FF5733"],
          borderColor: ["#ffffff", "#ffffff"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      animation: {
        animateRotate: true, // Enable rotation animation
        animateScale: true, // Enable scaling animation
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