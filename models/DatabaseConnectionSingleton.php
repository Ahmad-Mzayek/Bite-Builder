<?php
define("DB_USER", "");
define("DB_PASS", "");
define("DB_URL", "127.0.0.1");
define("DB_NAME", "bite_builder");

class DatabaseConnectionSingleton
{
    private ?mysqli $connection = null;
    private static ?DatabaseConnectionSingleton $instance = null;

    public static function get_instance(): DatabaseConnectionSingleton // -----------------------------------------------------
    {
        if (self::$instance === null)
            self::$instance = new DatabaseConnectionSingleton();
        if (!self::$instance->is_connected())
            self::$instance = new DatabaseConnectionSingleton();
        return self::$instance;
    }

    public function get_connection(): mysqli // -------------------------------------------------------------------------------
    {
        if (!$this->is_connected())
            throw new Exception("Database connection is closed.");
        return $this->connection;
    }

    private function __construct() // -----------------------------------------------------------------------------------------
    {
        $this->connection = new mysqli(DB_URL, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_error)
            throw new Exception("Database connection failed: " . $this->connection->connect_error);
    }

    private function is_connected(): bool // ----------------------------------------------------------------------------------
    {
        return $this->connection ? mysqli_ping($this->connection) : false;
    }

    private function __clone() : void {} // -----------------------------------------------------------------------------------

    private function __wakeup() : void {} // ----------------------------------------------------------------------------------
}
?>