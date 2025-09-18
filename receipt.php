<?php
session_start();
require_once "authentication.php";
$auth = new AuthPDO();
if(!isset ($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}

if (!isset($_GET['order_id'])) {
    header("Location: shoppingcart.php");
    exit;
}

$orderId = $_GET['order_id'];
$conn = $auth->getConnection();

$stmt = $conn->prepare("SELECT * FROM customer_orders WHERE order_id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Unknown';

if (!$order) {
    echo "Order not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Order Receipt</h2>
    <div class="card p-4">
        <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
        <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['first_name']) . ' ' . htmlspecialchars($order['last_name']) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>Total Paid:</strong> $<?= number_format($order['total_price'], 2) ?></p>
        <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
        <p>We will contanct you to verify your order! Print this page for convenience.</p>
    </div>
    <a href="main.php" class="btn btn-success mt-3">Back to Home</a>
</div>
</body>
</html>
