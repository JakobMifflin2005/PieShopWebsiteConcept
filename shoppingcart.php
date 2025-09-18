<?php
session_start();
require_once "authentication.php";
$auth = new AuthPDO();
if(!isset ($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}
if(isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["cart"]) ) {
        $session_array_id = array_column($_SESSION["cart"], "id");
        if (!in_array($_POST['id'], $session_array_id)) {
            $session_array = array(
                'id' => $_POST['id'],
                "name" => $_POST['name'],
                "price" => $_POST['price'],
                'quantity' => $_POST['quantity'],
    
            );
            $_SESSION["cart"][] = $session_array;
        }
    } else {
        $session_array = array(
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            'quantity' => $_POST['quantity'],

        );
        $_SESSION["cart"][] = $session_array;
    }
}
$query = "SELECT * FROM pies";
$stmt = $auth->getConnection()->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Shopping Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .my-header {
            display: block;
            padding: 8px;
            text-align: center;
            background-color: #ffc107;
        }
        .jeremy {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        background-color: #795548; /* Brownish theme */
    }
    .jeremy li {
        padding: 10px 20px;
    }
    .jeremy a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }
    .mypadding {
        padding: 16px;
    }
    h1 {
        font-size: 36px;
    }
    main {
        max-width: 5000px;
        margin: auto;
        margin-top: 10px;
        padding: 32px;
        background-color: #f4e1c1;
    }
    body {
        background-color: blue;
    }

        </style>
    </head>
    <header class="my-header">
        <h1>Drozdowsky's Pie Shop</h1>
    </header>
    <nav class ="mypadding">
        <ul class = "jeremy">
    <li><a href="main.php">Home</a></li>
  <li><a href="shoppingcart.php">Order</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="editview.php">User Info</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
        </nav>
    <body>
        <main>
        <div class = "container-fluid">
            <div class = "col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class = "text-center">Items</h2>
                        <div class="col-md-12">
                            <div class ="row">

                           


                        <?php foreach ($result as $row): ?>
                            <div class="col-md-4">
                                <form method="POST" action="shoppingcart.php">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                <img src="img/<?= htmlspecialchars($row['image']) ?>" style="height: 150px;">
                                <h5 class="text-center"><?= htmlspecialchars($row['name']) ?></h5>
                                <h5 class="text-center">$<?= number_format($row['price'], 2) ?></h5>
                                <input type ="hidden" name="name" value="<?= $row['name'] ?>">
                                <input type ="hidden" name="price" value="<?= $row['price'] ?>">
                                <input type ="number" name="quantity" value="1" min="1" max ="10" class="form-control">
                                <input type ="submit" name="add_to_cart" class="btn btn-warning btn-block my-2" value="Add To Cart">
                                </form>
                            </div>
                                <?php endforeach; ?>
                                </div>
                                </div>

                        
                    </div>
                    <div class ="col-md-6">
                        <h2 class="text-center">Item Selected</h2>
                        <?php
                        $total = 0;
                        $output = "";
                        $output .= "
                        <table class ='table table-bordered table-striped'>
                        <tr>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Item Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                        </tr>
                        ";

                        if (!empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $output .= " 
                                <tr>
                                
                                <td>".$value['name']."</td>
                                <td>".$value['price']."</td>
                                <td>".$value['quantity']."</td>
                                <td>".number_format($value['price'] * $value['quantity'], 2)."</td>
                                <td>
                                <a href ='shoppingcart.php?action=remove&id=".$value['id']."'>
                                <button class='btn btn-danger btn-block'>Remove</button>
                                </a>
                                </td>
                                </tr>";
                                $total = $total + ($value['quantity'] * $value['price']); 

                                
                                
                                
                            }
                        }
                        $output .= "
                        <tr>
                        <td colspan='2'></td>
                        <td></b>Total Price</b></td>
                        <td>".number_format($total,2)."</td>
                        <td>
                        <a href='shoppingcart.php?action=clearall'>
                        <button class ='btn btn-warning'>Clear</button>
                        </a>
                        </td>
                        </tr>
                        ";
                        echo $output;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if (isset($_GET['action'])) {
            if ($_GET['action'] == "clearall") {
                unset($_SESSION["cart"]);
            }
            if ($_GET['action'] == "remove")
            foreach($_SESSION['cart'] as $key => $value ) {
                if ($value['id'] == $_GET['id']) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
        
        ?>
        <div class="text-center mt-4">
    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
</div>
        </main>
    </body>
</html>