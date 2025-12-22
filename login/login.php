<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="form-box Login">
            <a href="../page2.php" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h2>Login</h2>
            <form method="POST" action="login_action.php" enctype="multipart/form-data">
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="input-box">
                    <button class="btn" type="submit">Login</button>
                </div>
                <div class="regi-link">
                    <p>Don't have an account?<a href="register.php"> Sing up</a></p>
                </div>
            </form>
            <?php
              if (isset($_SESSION["errors"])) {
                  echo "<div style='color:red; text-align:center'>";
                  foreach ($_SESSION["errors"] as $err) {
                      echo htmlspecialchars($err) . "<br>";
                  }
                  echo "</div>";
                  unset($_SESSION["errors"]);
              }
              ?>


        </div>
        <div class="info-content">
            <h2>WELCOME BACK!</h2>
        </div>

    </div>


</body>

</html>