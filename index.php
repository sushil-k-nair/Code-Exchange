<?php
session_start();
include("classes/connection.php");
include("classes/login.php");
include("classes/signup.php");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/slstyle.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <?php
                $email = "";
                $password = "";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $login = new Login();
                    $result = $login->evaluate($_POST);

                    if ($result != "") {
                        echo "<div class='register_error'>";
                        echo "<h3>The Following Error! Occured</h3>";
                        echo $result;
                        echo "</div>";
                    } else {
                        header("Location: profile.php");
                        die;
                    }

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                }
                ?>
                <form action="" class="sign-in-form loginForm" method="post">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" value="<?php echo $email ?>" placeholder="Email Id" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" value="<?php echo $password ?>" placeholder="Password" />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />

                </form>
                <?php
                $first_name = "";
                $last_name = "";
                $email = "";
                $gender = "";
                $phoneno = "";

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $signup = new Signup();
                    $result = $signup->evaluate($_POST);

                    if ($result != "") {
                        echo "<div class='register_error'>";
                        echo "<h3>The Following Error! Occured</h3>";
                        echo $result;
                        echo "</div>";
                    } else {
                        header("Location: index.php");
                        die;
                    }

                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email = $_POST['email'];
                    $gender = $_POST['gender'];
                    $phoneno =  $_POST['phoneno'];
                }


                ?>
                <form class="sign-up-form registerForm" method="post" action="">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" value="<?php echo $first_name ?>" name="first_name" placeholder="First Name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" value="<?php echo $last_name ?>" name="last_name" placeholder="Last Name" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" value="<?php echo $email ?>" name="email" placeholder="Email" />
                    </div>
                    <select name="gender" class="input-field sele">
                        <i class="fas"></i>
                        <option selected>Gender<?php echo $gender ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="phoneno" placeholder="Phone No" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" class="btn" value="Sign up" />

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                    <a href="home.php">
                        <p class="social-text">CODE EXCHANGE</p>
                    </a>
                </div>
                <img src="images/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                    <a href="home.php">
                        <p class="social-text">CODE EXCHANGE</p>
                    </a>
                </div>
                <img src="images/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>