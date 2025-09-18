<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once "authentication.php";
$auth = new AuthPDO();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

if (empty($_SESSION['cart'])) {
    header("Location: shoppingcart.php");
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = isset($_POST['firstname']) ? str_replace(' ', '', $_POST['firstname']) : '';
    $lastName = isset($_POST['lastname']) ? str_replace(' ', '', $_POST['lastname']) : '';
    $phone = isset($_POST['phone']) ? str_replace(' ', '', $_POST['phone']) : '';

if (empty($firstName) || empty($lastName) || empty($phone)) {
    $error = "Please fill out all fields.";
} else {
    $_SESSION['phone'] = $phone; 
    $username = $_SESSION['user']; 
$conn = $auth->getConnection();
$stmt = $conn->prepare("SELECT id FROM users WHERE name = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$userId = $user['id']; 

        $conn = $auth->getConnection();
        $stmt = $conn->prepare("INSERT INTO customer_orders (user_id, first_name, last_name, total_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $firstName, $lastName, $total]);

        unset($_SESSION['cart']);

        $orderId = $conn->lastInsertId();

        header("Location: receipt.php?order_id=" . $orderId);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
</head>
<body class="w3-blue">
    <main class="w3-container w3-card w3-sand w3-padding-32 w3-border w3-border-brown w3-round-large" style="max-width: 1000px; margin: auto; margin-top: 10px;">
        <h3>Checkout</h3>
        <?php 
        if (!empty($error)) echo "<p style='color:red;'>$error</p>";
        echo "<p><strong>Total:</strong> $" . number_format($total, 2) . "</p>";
        ?>
        <form method="POST" action="checkout.php">
            <label for="firstname">First Name: </label>
            <input type="text" id="firstname" name="firstname" class="w3-input w3-border" required><br>

            <label for="lastname">Last Name: </label>
            <input type="text" id="lastname" name="lastname" class="w3-input w3-border" required><br>

            <label for="phone">Phone Number: </label>
            <input type="text" id="phone" name="phone" class="w3-input w3-border" required><br>

            <input type="submit" value="Confirm Order" class="w3-button w3-green w3-margin">
        </form>
        <a href="shoppingcart.php">Back To Cart</a>
    </main>
</body>
</html>