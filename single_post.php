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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new Post();
    $id = $_SESSION['codeexchange_userid'];
    $result = $post->post_comment($id, $_POST);
    if ($result == "") {
        header("Location: single_post.php?id=$_GET[id]");
        die;
    } else {
        echo "<div class='register_error'>";
        echo "<h3>The Following Error! Occured</h3>";
        echo $result;
        echo "</div>";
    }
}

$Post = new Post();
$ROW = false;
$ERROR = "";

if (isset($_GET['id'])) {
    $ROW = $Post->get_one_post($_GET['id']);
} else {
    $ERROR = "No post was found!";
}

$USER = $user_data;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);
    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/head_include.php"); ?>

    <title>Comment</title>
</head>

<body>

    <!-- Navigation -->

    <?php include("includes/header.php"); ?>

    <!-- Navigation END-->

    <div class="profilebody">
        <h1>Comment Area</h1>
        <hr>
        <div class="post_sp">
            <?php
            $user = new User();
            if (is_array($ROW)) {

                $ROW_USER = $user->get_user($ROW['userid']);
                include("post.php");
            }
            ?>
            <form method="post">
                <div class="comment_sec">

                    <textarea type="text" name="post_title" placeholder="Comment here"></textarea>
                </div>
                <button type="submit">Comment</button>
            </form>
            <?php
            $comments = $Post->get_comment($ROW['postid']);
            if (is_array($comments)) {
                foreach ($comments as $COMMENT) {
                    include("comment.php");
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