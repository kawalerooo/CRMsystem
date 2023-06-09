<?php
include "../db/handler.php";

session_start();

$db = new DBHandler();

$db->create_ticket_message($_REQUEST["id"], $_SESSION["user_id"], $_POST["content"]);

header("Location: " . $_SERVER["HTTP_REFERER"]);