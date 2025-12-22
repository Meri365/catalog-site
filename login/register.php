<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="form-box Reg">
            <a href="../page2.php" style="
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 22px;
                color: white;
                text-decoration: none;
                cursor: pointer;
                z-index: 999;
            ">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <h2>Register</h2>
            <form method="POST" action="register_action.php" enctype="multipart/form-data">
                <!--1-->
                <div class="input-box">
                    <input type="text" name="name" required>
                    <label for="">Name</label>

                </div>
                <!--2-->
                <div class="input-box">
                    <input type="text" name="surname" required>
                    <label for="">Surname</label>

                </div>
                <!--3-->
                <div class="input-box">
                    <input type="text" name="email" required>
                    <label for="">Email</label>

                </div>
                <!--4-->
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>

                </div>
                <!--5-->
                <div class="input-box">
                    <input type="password" name="confirm_password" required>
                    <label for="">Confirm Password</label>

                </div>
                <div class="input-box">
                    <select name="gender" required>
                        <option value="" disabled selected hidden></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <label>Gender</label>
                </div>



                <div class="input-box">
                    <button class="btn" type="submit">register</button>
                </div>
                <div class="regi-link">
                    <p>Already have an account?<a href="login.php"> Log in</a></p>
                </div>
            </form>
            <?php
              if (isset($_SESSION["errors"])) {
                  echo "<div style='color:red'>";
                  foreach ($_SESSION["errors"] as $err) {
                      echo $err . "<br>";
                  }
                  echo "</div>";
                  unset($_SESSION["errors"]);
              }

              if (isset($_SESSION["success"])) {
                  echo "<div style='color:green'>" . $_SESSION["success"] . "</div>";
                  unset($_SESSION["success"]);
              }
            ?>
        </div>


    </div>


</body>

</html>