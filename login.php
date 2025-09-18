<?php
session_start();
require_once "authentication.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $auth = new AuthPDO();
    if($auth->login($_POST["name"], $_POST["password"])) {
    $_SESSION["user"] = $_POST["name"];
    header("Location: main.php");
    exit;
} else {
    $error = "Invalid username or Password";
}
}
include "loginform.php";







?>