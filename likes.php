<?php
session_start();
//including file from classes floder 
include("classes/connection.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['codeexchange_userid']);
$Post = new Post();
//delete post 
$ERROR = "";
$likes = false;
if (isset($_GET['id']) && isset($_GET['type'])) {
    $likes = $Post->get_likes($_GET['id'], $_GET['type']);
} else {
    $ERROR = "No information post was found!";
}



?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/head_include.php"); ?>

    <title>Post Likes</title>
</head>

<body>

    <!-- Navigation -->

    <?php include("includes/header.php"); ?>

    <!-- Navigation END-->

    <div class="profilebody">
        <h3>Result :</h3>
        <hr>
        <div class="search_result">
            <?php
            $User = new User();
            if (is_array($likes)) {
                foreach ($likes as $row) {
                    $FRIEND_ROW = $User->get_user($row['userid']);
                    include("user.php");
                }
            }
            ?>
        </div>

    </div>









    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>

</html>