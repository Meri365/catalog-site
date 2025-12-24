<?php
    require_once __DIR__ . "/login/Database.php";
    require_once __DIR__ . "/login/Product.php";

    $db = new Database();
    $productObj = new Product($db->conn, null); // user_id not needed for all products

    $allProducts = $productObj->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Page2</title>
    <link rel="stylesheet" href="page2.css">


</head>

<body>

    <header>
        <div class="logo">MODERN STYLE</div>
    </header>



    <div class="page2buttons">
        <button id="btnHome" class="but1" type="button">HOME</button>
        <button id="btnPage2" class="but1" type="button">PAGE@</button>
        <button id="btnLiving" class="but1" type="button">LIVING ROOM</button>
        <button id="btnDining" class="but2" type="button">DINING ROOM</button>
        <button id="btnBedroom" class="but3" type="button">BEDROOM</button>
        <button id="btnBathroom" class="but4" type="button">BATHROOM</button>
        <div>
            <button class="but3" type="button" onclick="window.location.href='login/login.php'">Log in</button>
            <button class="but4" type="button" onclick="window.location.href='login/register.php'">Register</button>
        </div>
    </div>



    <div class="img1">
        <img src="images6/img3.jpg" alt="living">
    </div>

    <div class="scroll-container">
        <div class="scrolling-text">
            • MODERN STYLE – Furniture for Modern Living • MODERN STYLE – Furniture for Modern Living • MODERN STYLE
            –
            Furniture for Modern Living •

        </div>
    </div>



    <div class="ads">
        <h2>Shop the Look</h2>
        <p>Cozy, stylish pieces that make your home feel warm and welcoming.</p>
    </div>
    <div class="wrapp">
        <!-- Card 1-->
        <div class="card">
            <img src="images6/img8.webp">
            <div class="info">

                <a href="#" class="btn0">Read more</a>

            </div>
        </div>
        <!--2-->

        <div class="card">
            <img src="images6/img4.jpg">
            <div class="info">

                <a href="#" class="btn0">Read more</a>

            </div>
        </div>
        <!--3-->

        <div class="card">
            <img src="images6/img10.webp">
            <div class="info">

                <a href="#" class="btn0">Read more</a>
            </div>
        </div>
    </div>

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
                <?php if (!empty($allProducts)): ?>
                <?php foreach ($allProducts as $p): ?>
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

    <footer style="background-color:rgba(118, 13, 13, 0.886)" class="site-footer">

        <div class="footer-top">
            <div class="footer-column">
                <h4>About Us</h4>
                <a href="#">Our Story</a>
                <a href="#">Contact Us</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
            </div>
            <div class="footer-column">
                <h4>Shopping With Us</h4>
                <a href="#">Refer a Friend</a>
                <a href="#">Free Swatches</a>
                <a href="#">Delivery</a>
                <a href="#">Help Center</a>
            </div>
            <div class="footer-column">
                <h4>Connect</h4>
                <div class="footer-social">
                    <p style="font-size:14px">Instagram<br>Facebook </p>
                </div>
            </div>
        </div>


        <hr>
        <div class="footer-text">© 2025 Your Company. All rights reserved.</div>
        </div>
    </footer>

    <script src="page2.js"></script>
</body>

</html>