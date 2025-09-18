<?php
require_once "authentication.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = new AuthPDO();
    $result = $auth->register($_POST["name"], $_POST["password"], $_POST["confirm"]);
    if ($result === true) {
        header("location:indexview.php");
        exit;
    } else {
        $error = $result;
    }
}
include "signupform.php";
?>