<?php
define("DB_USER", "");
define("DB_PASS", "");
define("DB_URL", "127.0.0.1");
define("DB_NAME", "bite_builder");

class DatabaseConnection
{
    private ?mysqli $database_connection = null;
    private static ?DatabaseConnection $instance = null;

    private function __construct()
	{
        $this->database_connection = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);
		$connection_error_message = $this->database_connection->connect_error;
        if ($connection_error_message)
            die("Database connection failed: " . $connection_error_message);
    }

    private function __clone() : void {}

    private function __wakeup() : void {}

    public static function get_instance() : DatabaseConnection
	{
        if (self::$instance === null)
            self::$instance = new DatabaseConnection();
        return self::$instance;
    }

    public function get_connection() : mysqli
	{
        return $this->database_connection;
    }
}
?>