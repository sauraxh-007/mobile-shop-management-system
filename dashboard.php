<?php
require_once 'config/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<main class="page-body">
  <h1>Welcome back, John 👋</h1>
  <p>Here's what's happening with your shop today.</p>

  <div class="stat-cards">
    <div class="card">
      <h3>Today's Sales</h3>
      <p>$0</p>
    </div>
    <div class="card">
      <h3>Pending Repairs</h3>
      <p>0</p>
    </div>
    <div class="card">
      <h3>Low Stock Alerts</h3>
      <p>0</p>
    </div>
  </div>

  <div class="card">
    <h3>Weekly Sales</h3>
    <canvas id="weeklySalesChart"></canvas>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php include 'includes/footer.php'; ?>
