<?php
include "../db/handler.php";

$username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
$password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");
$confirm_password = htmlentities($_POST["confirm-password"], ENT_QUOTES, "UTF-8");

if (empty($username) || empty($password) || $password != $confirm_password) {
  header("Location: ../signup.php");
  exit;
}

$db = new DBHandler();
$user = mysqli_fetch_array($db->find_user($username));

if (!$user) {
  $db->create_user($username, $password, 'client');
  header("Location: ../login.php");
} else {
  header("Location: ../signup.php");
}
