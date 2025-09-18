<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Information</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
        <style>
    body {
        font-family: 'Poppins', sans-serif;

    }
    h3 {
        font-size: 24px; /* Adjust based on preference */
        font-weight: bold;
    }
    p {
        font-size: 18px;
        line-height: 1.6; /* Improves readability */
    }
    ol, ul {
        font-size: 18px;
        line-height: 1.6; /* Improves readability */
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
  



</style>
    </head>
    <header class="w3-container w3-amber w3-padding w3-center">
        <h1 class="w3-xxlarge" >Edit Information</h1>
    </header>
    <nav class ="w3-padding">
        <ul class = "jeremy">
        <li><a href="main.php">Home</a></li>
  <li><a href="shoppingcart.php">Order</a></li>
  <li><a href="news.php">News</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="editview.php">User Info</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
        </nav>
    <body class="w3-blue">
    <div class="w3-container w3-card w3-sand w3-padding-64 w3-border w3-border-brown w3-round-large" style="max-width: 1000px; margin: auto; margin-top: 10px;">
<?php 
session_start();
require_once "authentication.php";
if(!isset ($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}
echo "<h3 class='w3-center'>Current User Information</h3>";
$auth = new AuthPDO();
$userData = $auth->showData($_SESSION["user"]);
if ($userData) {
    echo "<p>User ID: " . htmlspecialchars($userData["id"]) . "</p></br>";
    echo "<p>UserName: " . htmlspecialchars($userData["name"]) . "</p></br>";
} else {
    "<p>You are not data?. </p>";
}
if (!empty($error)) echo "<p style='color:red;'>$error</p>";
if (isset($_GET['success']) && $_GET['success'] == 'username') {
    echo '<div class="w3-panel w3-green w3-round-large w3-padding">
    <strong>Username Changed!</strong> Sending you to the index page...
  </div>';
header("refresh:3; url=indexview.php"); // Redirect after 3 seconds
}
if (isset($_GET['success']) && $_GET['success'] == 'password') {
    echo '<div class="w3-panel w3-green w3-round-large w3-padding">
    <strong>Password Changed!</strong> Sending you to the index page...
  </div>';
header("refresh:3; url=indexview.php"); // Redirect after 3 seconds
}
if (isset($_GET['success']) && $_GET['success'] == 'delete') {
    echo '<div class="w3-panel w3-red w3-round-large w3-padding">
    <strong>Account Being Deleted</strong> Sorry to see you go...
  </div>';
header("refresh:3; url=indexview.php"); // Redirect after 3 seconds
}


echo <<<HTML
<details class ="w3-container w3-padding w3-card">
    <summary class = "w3-button w3-blue">Edit Info</summary>
    <form action="updateusername.php" method="POST" class="w3-padding">
        <label for="name">New Username: </label>
        <input type = "text" id ="name" name = "name" class="w3-input w3-border" required><br>
        <input type="submit" value="Update Username" class="w3-button w3-green w3-margin">
        </form>
         <form action="updatepassword.php" method="POST" class="w3-padding">
         <label for="current">Current Password: </label>
         <input type="password" id="current" name="current" class="w3-input w3-border" required><br>
         <label for="password">New Password: </label>
         <input type="password" id="password" name="password" class="w3-input w3-border" required><br>
         <label for="confirm">Confirm New Password: </label>
         <input type="password" id="confirm" name="confirm" class="w3-input w3-border" required><br>
         <input type="submit" value="Update Password" class="w3-button w3-green w3-margin" required>
         </form>
</details>
<br><br>
<details class ="w3-container w3-padding-32px" style = "margin auto">
<summary class = "w3-button w3-red w3-margin-right">DELETE ACCOUNT</summary>
<form action="delete.php" method="POST" class="w3-padding">
<label for="password">Current Password: </label>
<input type="password" id="password" name="password" class="w3-input w3-border" required><br>
         <label for="confirm">Confirm Password: </label>
         <input type="password" id="confirm" name="confirm" class="w3-input w3-border" required><br>
         <input type="submit" value="Confirm" class="w3-button w3-red w3-margin">
    </form>
</details>

    


HTML;







?>
</div>

</body>
</html>