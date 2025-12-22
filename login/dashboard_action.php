<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "Database.php";
require_once "Product.php";

$db = new Database();
$productObj = new Product($db->conn, $_SESSION['user_id']);

// որպեսզի ձևաթղթի ներկայացումը կարգավորվի
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $productObj->add($_POST);

    if ($result['success']) {
        $_SESSION['success_message'] = $result['message'];
    } else {
        $_SESSION['error_message'] = $result['message'];
    }

    header("Location: dashboard.php");
    exit;
}

//  ապրանքները Վերցնելու և ցուցադրման համար
$products = $productObj->getAll();
?>