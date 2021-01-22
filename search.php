<?php
//including file from classes floder 
session_start();
include("classes/connection.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/profile.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['codeexchange_userid']);

if (isset($_GET['find'])) {
    $find = addslashes($_GET['find']);

    $sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
    $DB = new  Database();
    $results = $DB->read($sql);
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/head_include.php"); ?>

    <title>Searched Result !</title>
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
            if (is_array($results)) {
                foreach ($results as $row) {
                    $FRIEND_ROW = $User->get_user($row['userid']);
                    include("user.php");
                }
            } else {
                echo  "No result were Found :( ";
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