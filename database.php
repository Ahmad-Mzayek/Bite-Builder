<?php

$DB_URL = "127.0.0.1";
$DB_USER = "";
$DB_PASS = "";
$DB_NAME = "bite_builder";

$mysqli = new mysqli($DB_URL, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_error)
	die("Database connection failed: " . $mysqli->connect_error);