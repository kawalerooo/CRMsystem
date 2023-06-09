<?php
include "../db/handler.php";

session_start();

$db = new DBHandler();

$db->rate_ticket($_REQUEST["id"], $_POST["rating"]);

header("Location: " . $_SERVER["HTTP_REFERER"]);