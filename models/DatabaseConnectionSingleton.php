<?php
define("DB_USER", "root");
define("DB_PASS", "1234");
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

    public function __clone() : void // ---------------------------------------------------------------------------------------
    {
        throw new Exception("Cloning of this database connection object is not allowed.");
    }

    public function __wakeup() : void // --------------------------------------------------------------------------------------
    {
        throw new Exception("Deserialization of this database connection object is not allowed.");
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
}
?>