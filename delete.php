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


//collecting post from database and visible to user
$post = new Post();
$id = $_SESSION['codeexchange_userid'];

$posts = $post->get_all_posts($id);

if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "delete.php")) {
    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
}

//delete post 
$ERROR = "";
if (isset($_GET['id'])) {

    $ROW = $Post->get_one_post($_GET['id']);

    if (!$ROW) {
        $ERROR = "No such post was found!";
    } else {
        if ($ROW['userid'] != $_SESSION['codeexchange_userid']) {
            $ERROR = "It seems you are not have access to delete this post";
        }
    }
} else {
    $ERROR = "No such post was found!";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Post->delete_post($_POST['postid']);
    header("Location: " . $_SESSION['return_to']);
    die;
}



?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/head_include.php"); ?>

    <title>Delete Post !</title>
</head>

<body>

    <!-- Navigation -->

    <?php include("includes/header.php"); ?>

    <!-- Navigation END-->

    <div class="profilebody">
        <h1>Are you sure you want to delete this post ?</h1>
        <hr>
        <div class="post_sp">
            <?php
            if ($ERROR != "") {
                echo $ERROR;
            } else {

                $user = new User();
                $ROW_USER = $user->get_user($ROW['userid']);
                include("post_delete.php");


                echo "<div class='deletearea_btn'>";
                echo "<a href='profile.php'><button>Cancel</button></a>";
                echo "<form method='post'>";
                echo "<input class='delete_btn' type='hidden' name='postid' value='$ROW[postid]'>";
                echo "<input class='delete_btn' type='submit' value='Delete'>";
                echo "</form>";
                echo "</div>";
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