<?php
require_once "authentication.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$auth = new AuthPDO();
$result = $auth->changePassword($_POST["current"], $_POST["password"], $_POST["confirm"] );
if ($result === true) {
    header("Location: editview.php?success=password");
    
    exit;
} else {
    $error = $result;
}
}
include "editview.php";
?>