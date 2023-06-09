<?php
include "../db/handler.php";

session_start();

$db = new DBHandler();

$db->create_ticket($_SESSION["user_id"], $_POST["category"]);
$ticket = mysqli_fetch_array($db->find_last_ticket($_SESSION["user_id"]));

$db->create_ticket_message($ticket["id"], $_SESSION["user_id"], $_POST["content"]);

header("Location: " . $_SERVER["HTTP_REFERER"]);