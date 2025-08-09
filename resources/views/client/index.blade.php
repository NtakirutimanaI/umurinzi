@include('client.header')
@include('client.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Client Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f5f7fa;
      color: #333;
      padding: 20px;
      margin-top: 60px;
    }

    .dash-wrapper {
      max-width: 1200px;
      margin-left: 240px;
      width: 80%;
      padding: 0 10px;
    }

    .dash-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .dash-header h1 {
      font-size: 22px;
      font-weight: 600;
      color: #00C853;
    }

    .dash-stats {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .dash-card {
      background: #fff;
      flex: 1 1 200px;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dash-card h3 {
      font-size: 14px;
      color: #888;
      margin-bottom: 10px;
    }

    .dash-card p {
      font-size: 22px;
      font-weight: bold;
      color: #00C853;
    }

    .dash-charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .chart-box {
      background: #fff;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .chart-box h4 {
      margin-bottom: 15px;
      font-size: 16px;
      color: #00C853;
    }

    .activity-section {
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .activity-section h4 {
      font-size: 18px;
      margin-bottom: 20px;
      color: #00C853;
    }

    .activity-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .activity-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f0f0f0;
      padding: 12px 16px;
      border-radius: 12px;
    }

    .activity-item span {
      font-size: 14px;
      color: #555;
    }

    .activity-item .status {
      font-size: 13px;
      background: #c8e6c9;
      color: #2e7d32;
      padding: 4px 10px;
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      .dash-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .dash-header input {
        width: 100%;
      }

      .dash-wrapper {
        margin-left: 0;
        width: 100%;
        padding: 0 15px;
      }
    }
  </style>
</head>
<body>
  <div class="dash-wrapper">
    <div class="dash-header">
      <h1>Welcome, Client 👋</h1>
    </div>

    <div class="dash-stats">
      <div class="dash-card">
        <h3>Your Bookings</h3>
        <p>4 Active</p>
      </div>
      <div class="dash-card">
        <h3>Messages</h3>
        <p>3 Unread</p>
      </div>
      <div class="dash-card">
        <h3>Notifications</h3>
        <p>2 New</p>
      </div>
    </div>

    <div class="dash-charts">
      <div class="chart-box">
        <h4>Booking Overview</h4>
        <canvas id="barChart"></canvas>
      </div>
      <div class="chart-box">
        <h4>Service Usage</h4>
        <canvas id="pieChart"></canvas>
      </div>
    </div>

    <div class="activity-section">
      <h4>Recent Activity</h4>
      <div class="activity-list">
        <div class="activity-item">
          <span>Tailoring booking confirmed</span>
          <span class="status">Confirmed</span>
        </div>
        <div class="activity-item">
          <span>Mechanic service scheduled</span>
          <span class="status">Pending</span>
        </div>
        <div class="activity-item">
          <span>Meeting with technician</span>
          <span class="status">Upcoming</span>
        </div>
      </div>
    </div>
  </div>

  <script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
          label: 'Bookings',
          data: [3, 5, 2, 6, 4],
          backgroundColor: '#00C853',
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        labels: ['Tailor', 'Mechanic', 'Technician'],
        datasets: [{
          data: [45, 35, 20],
          backgroundColor: ['#00C853', '#a5d6a7', '#e0f2f1'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        cutout: '70%',
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });
  </script>
</body>
</html>


@include('client.footer')
