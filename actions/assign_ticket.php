<?php
include "../db/handler.php";

session_start();

$db = new DBHandler();

$db->assign_ticket($_REQUEST["id"], $_SESSION["user_id"]);

header("Location: " . $_SERVER["HTTP_REFERER"]);