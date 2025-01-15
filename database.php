<?php
define("DB_USER", "");
define("DB_PASS", "");
define("DB_URL", "127.0.0.1");
define("DB_NAME", "bite_builder");

$database_connection = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);
$database_connection_error_message = $database_connection->connect_error;
if ($database_connection_error_message)
	die("Database connection failed: " . $database_connection_error_message);
?>