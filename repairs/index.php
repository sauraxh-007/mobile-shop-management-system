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
// TODO: replace with SELECT * FROM repair_tickets ORDER BY created_at DESC once table exists
$dummy_tickets = [
    ["id" => "RT-201", "customer" => "Ramesh Patel", "device" => "iPhone 12", "issue" => "Cracked screen", "technician" => "Vikas", "status" => "in-repair"],
    ["id" => "RT-202", "customer" => "Priya Shah", "device" => "Samsung M31", "issue" => "Battery draining fast", "technician" => "Vikas", "status" => "received"],
    ["id" => "RT-203", "customer" => "Amit Desai", "device" => "OnePlus Nord", "issue" => "Charging port loose", "technician" => "Rahul", "status" => "waiting-parts"],
    ["id" => "RT-204", "customer" => "Sneha Joshi", "device" => "Redmi Note 11", "issue" => "Screen replacement", "technician" => "Rahul", "status" => "ready"],
];
$status_labels = [
    "received" => "Received", "diagnosed" => "Diagnosed", "waiting-parts" => "Waiting for Parts",
    "in-repair" => "In Repair", "ready" => "Ready", "delivered" => "Delivered"
];
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Repairs</h1>
      <p>Track repair jobs from intake to delivery</p>
    </div>
    <a href="new_ticket.php" class="btn btn-primary-sm">+ New Repair Ticket</a>
  </div>

  <div class="card">
    <div class="table-toolbar">
      <input type="text" class="search-input" placeholder="🔍 Search ticket, customer, device...">
      <button class="btn-icon-sm">Status ▾</button>
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Customer</th>
          <th>Device</th>
          <th>Issue</th>
          <th>Technician</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dummy_tickets as $t): ?>
        <tr>
          <td><strong><?= htmlspecialchars($t['id']) ?></strong></td>
          <td><?= htmlspecialchars($t['customer']) ?></td>
          <td><?= htmlspecialchars($t['device']) ?></td>
          <td><?= htmlspecialchars($t['issue']) ?></td>
          <td><?= htmlspecialchars($t['technician']) ?></td>
          <td><span class="status-pill <?= $t['status'] ?>"><?= $status_labels[$t['status']] ?></span></td>
          <td>
            <div class="action-icons">
              <a href="update_status.php" class="btn-icon-sm">Update</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
<?php include '../includes/footer.php'; ?>