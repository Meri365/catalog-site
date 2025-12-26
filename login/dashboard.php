<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$success_message = $_SESSION['success_message'] ?? '';
$error_message   = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);

require "dashboard_action.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<style>

</style>

<body>
    <h1>Products</h1>
    <button id="logout" class="but1" type="button" onclick="window.location.href='../page2.php'">Log out</button>
    <?php if ($success_message): ?> <div class=" message success"><?= htmlspecialchars($success_message) ?>
    </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
    <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>
    <div class="box">
        <table>
            <tbody>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Color</th>
                    <th>Price</th>
                </tr>
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['description']) ?></td>
                    <td><?= $p['quantity'] ?></td>
                    <td><?= htmlspecialchars($p['weight']) ?></td>
                    <td><?= htmlspecialchars($p['color']) ?></td>
                    <td>$<?= number_format($p['price'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No products yet</td>
                </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

    <div class="colorpart">
        <h2>__You can add your product here__</h2>
    </div>
    <div class="form-container">
        <?php if($success_message): ?>
        <div class="message success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>

        <?php if($error_message): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <form method="POST" action="dashboard_action.php">
            <div class="form-group">
                <label>PRODUCT NAME</label>
                <input type="text" placeholder="Enter product name" name="product_name">
            </div>

            <div class="form-group">
                <label>DESCRIPTION</label>
                <textarea placeholder="Enter product description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label>QUANTITY</label>
                <input type="number" placeholder="Enter quantity" name="quantity">
            </div>

            <div class="form-group">
                <label>WEIGHT</label>
                <input type="text" placeholder="Enter weight (kg)" name="weight">
            </div>

            <div class="form-group">
                <label>COLOR</label>
                <input type="text" placeholder="Enter color" name="color">
            </div>

            <div class="form-group">
                <label>PRICE</label>
                <input type="number" placeholder="Enter price" name="price">
            </div>

            <button type="submit" class="btn">SAVE & ADD ANOTHER</button>
        </form>
    </div>
</body>

</html>