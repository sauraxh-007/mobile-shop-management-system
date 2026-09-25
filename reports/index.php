<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';
include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Reports</h1>
      <p>Sales, repair, and inventory summaries</p>
    </div>
  </div>

  <div class="stat-cards">
    <div class="card stat-card">
      <div class="stat-icon">💰</div>
      <div class="stat-info">
        <h3>Total Sales (This Month)</h3>
        <div class="value">₹0</div>
      </div>
    </div>
    <div class="card stat-card">
      <div class="stat-icon">🔧</div>
      <div class="stat-info">
        <h3>Repair Income (This Month)</h3>
        <div class="value">₹0</div>
      </div>
    </div>
    <div class="card stat-card">
      <div class="stat-icon">📦</div>
      <div class="stat-info">
        <h3>Current Stock Value</h3>
        <div class="value">₹0</div>
      </div>
    </div>
  </div>

  <div class="card chart-card">
    <div class="chart-header">
      <div>
        <h3>Sales vs Repair Income</h3>
        <p>Monthly comparison</p>
      </div>
      <button class="btn-icon-sm">This Year ▾</button>
    </div>
    <canvas id="reportsChart" height="90"></canvas>
  </div>

  <div class="card">
    <h3 style="margin-bottom:16px;">Report Filters</h3>
    <div class="form-row" style="max-width:600px;">
      <div class="form-group">
        <label>Report Type</label>
        <select name="report_type">
          <option>Sales Report</option>
          <option>Repair Report</option>
          <option>Inventory Report</option>
        </select>
      </div>
      <div class="form-group">
        <label>Date Range</label>
        <select name="date_range">
          <option>This Week</option>
          <option>This Month</option>
          <option>This Year</option>
        </select>
      </div>
    </div>
    <button class="btn btn-primary-sm" style="margin-top:16px;">Generate Report</button>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('reportsChart');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun'],
    datasets: [
      { label: 'Sales', data: [0,0,0,0,0,0], borderColor: '#2563eb', tension: 0.3 },
      { label: 'Repairs', data: [0,0,0,0,0,0], borderColor: '#93c5fd', tension: 0.3 }
    ]
  },
  options: { responsive: true, plugins: { legend: { position: 'top', align: 'start' } } }
});
</script>

<?php include '../includes/footer.php'; ?>