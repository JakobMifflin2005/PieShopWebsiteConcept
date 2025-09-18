<?php
require_once "authentication.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$auth = new AuthPDO();
$result = $auth->changeUsername($_POST["name"]);
if ($result === true) {
    header("Location: editview.php?success=username");
    
    exit;
} else {
    $error = $result;
}
}
include "editview.php";
?>
