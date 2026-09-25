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
      <h1>New Repair Ticket</h1>
      <p>Log a new device repair request</p>
    </div>
  </div>

  <div class="card form-card">
    <form method="POST" action="">
      <div class="form-row">
        <div class="form-group">
          <label>Customer Name</label>
          <input type="text" name="customer_name" placeholder="Customer name" required>
        </div>
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="customer_phone" placeholder="Contact number" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Device Model</label>
          <input type="text" name="device_model" placeholder="e.g. iPhone 13" required>
        </div>
        <div class="form-group">
          <label>IMEI Number</label>
          <input type="text" name="imei" placeholder="Device IMEI">
        </div>
      </div>

      <div class="form-group">
        <label>Issue Description</label>
        <textarea name="issue_description" placeholder="Describe the problem..." required></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Assign Technician</label>
          <select name="technician" required>
            <option value="">Select technician</option>
            <option value="vikas">Vikas</option>
            <option value="rahul">Rahul</option>
          </select>
        </div>
        <div class="form-group">
          <label>Estimated Cost (₹)</label>
          <input type="number" name="estimated_cost" placeholder="0">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary-sm">Create Ticket</button>
        <a href="index.php" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</main>
<?php include '../includes/footer.php'; ?>