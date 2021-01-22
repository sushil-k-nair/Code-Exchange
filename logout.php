<?php
session_start();

unset($_SESSION['codeexchange_userid']);
header("Location: index.php");
die;


?>