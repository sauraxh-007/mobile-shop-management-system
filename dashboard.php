<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
require_once 'config/db.php';

// Today's Sales total
$today_sales = 0;
$res = $conn->query("SELECT SUM(total_amount) as total FROM sales WHERE DATE(created_at) = CURDATE()");
if ($res && $row = $res->fetch_assoc()) {
    $today_sales = $row['total'] ?? 0;
}

// Pending Repairs count (not delivered)
$pending_repairs = 0;
$res = $conn->query("SELECT COUNT(*) as cnt FROM repair_tickets WHERE status != 'delivered'");
if ($res && $row = $res->fetch_assoc()) {
    $pending_repairs = $row['cnt'] ?? 0;
}

// Low Stock Alerts count
$low_stock_count = 0;
$res = $conn->query("SELECT COUNT(*) as cnt FROM inventory_items WHERE quantity <= reorder_level");
if ($res && $row = $res->fetch_assoc()) {
    $low_stock_count = $row['cnt'] ?? 0;
}

// Low stock product list (for the table)
$low_stock_items = $conn->query("SELECT name, category, quantity, reorder_level FROM inventory_items WHERE quantity <= reorder_level ORDER BY quantity ASC LIMIT 5");

// Weekly sales data (last 7 days, Mon-Sun labels with actual totals)
$weekly_sales = array_fill(0, 7, 0);
$res = $conn->query("SELECT DAYOFWEEK(created_at) as dow, SUM(total_amount) as total FROM sales WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) GROUP BY DAYOFWEEK(created_at)");
while ($res && $row = $res->fetch_assoc()) {
    // DAYOFWEEK: 1=Sunday ... 7=Saturday -> convert to Mon-first index (0=Mon...6=Sun)
    $idx = ($row['dow'] + 5) % 7;
    $weekly_sales[$idx] = (float)$row['total'];
}

include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<main class="page-body">
  <h1>Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?> 👋</h1>
  <p style="color:var(--text-muted); margin-bottom:24px;">Here's what's happening with your shop today.</p>

  <div class="stat-cards">
    <div class="card stat-card">
      <div class="stat-icon">🛒</div>
      <div class="stat-info">
        <h3>Today's Sales</h3>
        <div class="value">₹<?= number_format($today_sales) ?></div>
      </div>
    </div>

    <div class="card stat-card">
      <div class="stat-icon">🔧</div>
      <div class="stat-info">
        <h3>Pending Repairs</h3>
        <div class="value"><?= $pending_repairs ?></div>
      </div>
    </div>

    <div class="card stat-card">
      <div class="stat-icon">⚠️</div>
      <div class="stat-info">
        <h3>Low Stock Alerts</h3>
        <div class="value"><?= $low_stock_count ?></div>
      </div>
      <?php if ($low_stock_count > 0): ?>
        <span class="stat-badge danger"><?= $low_stock_count ?> items</span>
      <?php endif; ?>
    </div>
  </div>

  <div class="card chart-card">
    <div class="chart-header">
      <div>
        <h3>Weekly Sales</h3>
        <p>Sales performance over the past 7 days</p>
      </div>
    </div>
    <canvas id="weeklySalesChart" height="90"></canvas>
  </div>

  <div class="card">
    <h3>Low Stock Products</h3>
    <table class="stock-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Reorder Level</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($low_stock_items && $low_stock_items->num_rows > 0): ?>
          <?php while ($li = $low_stock_items->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($li['name']) ?></td>
            <td><?= htmlspecialchars($li['category']) ?></td>
            <td><?= $li['quantity'] ?></td>
            <td><?= $li['reorder_level'] ?></td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" style="text-align:center; color:var(--text-muted);">No low stock items 🎉</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('weeklySalesChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [
      {
        label: 'Sales',
        data: <?= json_encode(array_values($weekly_sales)) ?>,
        backgroundColor: '#2563eb',
        borderRadius: 6
      }
    ]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'top', align: 'start' } },
    scales: { y: { beginAtZero: true } }
  }
});
</script>

<?php include 'includes/footer.php'; ?>