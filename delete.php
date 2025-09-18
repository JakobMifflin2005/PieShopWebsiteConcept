<?php
require_once "authentication.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$auth = new AuthPDO();
$result = $auth->deleteAccount($_POST["password"], $_POST["confirm"] );
if ($result === true) {
    header("Location: editview.php?success=delete");
    
    exit;
} else {
    $error = $result;
}
}
include "editview.php";
?>