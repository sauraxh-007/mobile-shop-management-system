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
// TODO: replace with SELECT * FROM sales ORDER BY date DESC once table exists
$dummy_sales = [
    ["id" => "INV-1001", "customer" => "Walk-in Customer", "items" => 2, "total" => 65150, "mode" => "UPI", "date" => "24 Sep 2026"],
    ["id" => "INV-1002", "customer" => "Ramesh Patel", "items" => 1, "total" => 200, "mode" => "Cash", "date" => "24 Sep 2026"],
    ["id" => "INV-1003", "customer" => "Walk-in Customer", "items" => 3, "total" => 950, "mode" => "Card", "date" => "23 Sep 2026"],
];
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Sales</h1>
      <p>View sales history and create new bills</p>
    </div>
    <a href="new_sale.php" class="btn btn-primary-sm">+ New Sale</a>
  </div>

  <div class="card">
    <div class="table-toolbar">
      <input type="text" class="search-input" placeholder="🔍 Search invoice, customer...">
      <button class="btn-icon-sm">This Week ▾</button>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>Invoice ID</th>
          <th>Customer</th>
          <th>Items</th>
          <th>Total</th>
          <th>Payment Mode</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dummy_sales as $sale): ?>
        <tr>
          <td><strong><?= htmlspecialchars($sale['id']) ?></strong></td>
          <td><?= htmlspecialchars($sale['customer']) ?></td>
          <td><?= $sale['items'] ?></td>
          <td>₹<?= number_format($sale['total']) ?></td>
          <td><?= htmlspecialchars($sale['mode']) ?></td>
          <td><?= htmlspecialchars($sale['date']) ?></td>
          <td>
            <div class="action-icons">
              <a href="invoice.php" class="btn-icon-sm">View</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
<?php include '../includes/footer.php'; ?>