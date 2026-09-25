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

// TODO: fetch real customer by ID from URL param once table exists
$customer = ["name" => "Ramesh Patel", "phone" => "9876543210", "email" => "ramesh@example.com"];
$history = [
    ["type" => "Sale", "ref" => "INV-1001", "desc" => "iPhone 13 + Tempered Glass", "amount" => 65150, "date" => "24 Sep 2026"],
    ["type" => "Repair", "ref" => "RT-201", "desc" => "iPhone 12 - Screen replacement", "amount" => 2500, "date" => "10 Sep 2026"],
    ["type" => "Sale", "ref" => "INV-0987", "desc" => "Charging Cable", "amount" => 200, "date" => "02 Sep 2026"],
];
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1><?= htmlspecialchars($customer['name']) ?></h1>
      <p><?= htmlspecialchars($customer['phone']) ?> &nbsp;•&nbsp; <?= htmlspecialchars($customer['email']) ?></p>
    </div>
    <a href="index.php" class="btn btn-outline">← Back to Customers</a>
  </div>

  <div class="card">
    <div class="stat-mini-row">
      <div class="stat-mini">
        <div class="label">Total Purchases</div>
        <div class="value">2</div>
      </div>
      <div class="stat-mini">
        <div class="label">Total Repairs</div>
        <div class="value">1</div>
      </div>
      <div class="stat-mini">
        <div class="label">Total Spent</div>
        <div class="value">₹67,850</div>
      </div>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>Type</th>
          <th>Reference</th>
          <th>Description</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($history as $h): ?>
        <tr>
          <td><span class="status-pill <?= $h['type']=='Sale' ? 'in-stock' : 'in-repair' ?>"><?= $h['type'] ?></span></td>
          <td><strong><?= htmlspecialchars($h['ref']) ?></strong></td>
          <td><?= htmlspecialchars($h['desc']) ?></td>
          <td>₹<?= number_format($h['amount']) ?></td>
          <td><?= htmlspecialchars($h['date']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
<?php include '../includes/footer.php'; ?>