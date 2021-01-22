<?php
session_start();
//including file from classes floder 
include("classes/connection.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/profile.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['codeexchange_userid']);

//profile friends
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET["id"]);
    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}
//post uploading process in database

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $post = new Post();
    $id = $_SESSION['codeexchange_userid'];
    $result = $post->create_post($id, $_POST);

    if ($result == "") {
        header("LOCATION: profile.php");
        die;
    } else {
        echo "<div class='register_error'>";
        echo "<h3>The Following Error! Occured</h3>";
        echo $result;
        echo "</div>";
    }
}

//collecting post from database and visible to user
$post = new Post();
$id = $user_data['userid'];

$posts = $post->get_posts($id);

//friends
$user = new User();

$friends = $user->get_friends($id);


?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/head_include.php"); ?>

    <title><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?> | Profile</title>
</head>

<body>

    <!-- Navigation -->

    <?php include("includes/header.php"); ?>

    <!-- Navigation END-->

    <!-- PROFILE NAME -->

    <div class="name">
        <div class=" sjfsj">
            <img src="./Images/1.jpg" alt="">
            <h5 class="text-center pt-3">
                <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
            </h5>
            <p class="text-muted text-center">
                Software Engineer
            </p>
            <hr>
        </div>
    </div>

    <!-- PROFILE END NAME -->

    <!-- PROFILE CONTACT -->

    <div class="contact">
        <div class="gender cl">Gender : <?php echo $user_data['gender'] ?></div>
        <div class="phno cl">Phone no : <?php echo $user_data['phoneno'] ?></div>
        <div class="emailid cl">Email-id : <?php echo $user_data['email'] ?></div>
    </div>

    <!-- PROFILE END CONTACT -->

    <!-- PROFILE BODY -->

    <hr>
    <div class="profilebody">
        <?php
        if ($posts) {
            foreach ($posts as $ROW) {
                $user = new User();
                $ROW_USER = $user->get_user($ROW['userid']);
                include("post.php");
            }
        }
        ?>
    </div>

    <!-- PROFILE END BODY -->











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