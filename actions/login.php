<?php
include "../db/handler.php";

session_start();

$username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
$password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

$db = new DBHandler();
$user = mysqli_fetch_array($db->find_user($username));

if ($user && $user["password"] == $password) {
    $_SESSION["is_authenticated"] = true;
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    header("Location: ../index.php");
} else {
    header("Location: ../login.php");
}
