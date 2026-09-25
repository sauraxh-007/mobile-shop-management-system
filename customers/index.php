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
// TODO: replace with SELECT * FROM customers once table exists
$dummy_customers = [
    ["name" => "Ramesh Patel", "phone" => "9876543210", "purchases" => 3, "repairs" => 2, "total_spent" => 68500],
    ["name" => "Priya Shah", "phone" => "9823456712", "purchases" => 1, "repairs" => 1, "total_spent" => 1200],
    ["name" => "Amit Desai", "phone" => "9765432180", "purchases" => 0, "repairs" => 1, "total_spent" => 800],
    ["name" => "Sneha Joshi", "phone" => "9998887771", "purchases" => 2, "repairs" => 1, "total_spent" => 3400],
];
function initials($name) {
    $parts = explode(' ', $name);
    return strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
}
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Customers</h1>
      <p>View customer purchase and repair history</p>
    </div>
    <a href="#" class="btn btn-primary-sm">+ Add Customer</a>
  </div>

  <div class="card">
    <div class="table-toolbar">
      <input type="text" class="search-input" placeholder="🔍 Search by name or phone...">
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Phone</th>
          <th>Purchases</th>
          <th>Repairs</th>
          <th>Total Spent</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dummy_customers as $c): ?>
        <tr>
          <td>
            <div class="item-cell">
              <div class="customer-avatar"><?= initials($c['name']) ?></div>
              <strong><?= htmlspecialchars($c['name']) ?></strong>
            </div>
          </td>
          <td><?= htmlspecialchars($c['phone']) ?></td>
          <td><?= $c['purchases'] ?></td>
          <td><?= $c['repairs'] ?></td>
          <td>₹<?= number_format($c['total_spent']) ?></td>
          <td>
            <div class="action-icons">
              <a href="view.php" class="btn-icon-sm">View History</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
<?php include '../includes/footer.php'; ?>