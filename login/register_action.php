<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "Database.php";
require_once "User.php";

$db = new Database();
$userObj = new User($db->conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $result = $userObj->register($_POST);

    if ($result['success']) {
        $_SESSION["success"] = $result['message'];
        header("Location: register.php");
        exit;
    } else {
        $_SESSION["errors"] = $result['errors'];
        header("Location: register.php");
        exit;
    }
}
?>