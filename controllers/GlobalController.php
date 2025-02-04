<?php
class GlobalController
{
    public static function resume_session() : void // -----------------------------------------------------------------------------------------------
    {
        if (session_status() === PHP_SESSION_NONE && !session_start())
            throw new Exception("Failed to start the session.");
        if (!isset($_SESSION["last_regeneration"]) || time() - $_SESSION["last_regeneration"] > 600)
        {
            if (!session_regenerate_id(true))
                throw new Exception("Failed to regenerate session ID.");
            $_SESSION["last_regeneration"] = time();
        }
    }

    public static function send_response(string $status, mixed $message) : void // ------------------------------------------------------------------
    {
        header("Content-Type: application/json");
        $response = ["status" => $status, "message" => $message];
        echo json_encode($response);
    }

    public static function prepare_statement(mysqli $database_connection, string $query) : mysqli_stmt // -------------------------------------------
    {
        $statement = $database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . $database_connection->error);
        return $statement;
    }

    public static function execute_statement(mysqli_stmt $statement) : void // ----------------------------------------------------------------------
    {
        if (!$statement->execute())
        {
            $error_message = "Database query execution failed: " . $statement->error;
            $statement->close();
            throw new Exception($error_message);
        }
    }

    public static function fetch_post_values(array $keys) : array // --------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        $values = array();
        foreach ($keys as $key)
            $values[] = self::fetch_post($key);
        return $values;
    }

    public static function fetch_get_values(array $keys) : array // ---------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET")
            throw new Exception("Invalid request method.");
        $values = array();
        foreach ($keys as $key)
            $values[] = self::fetch_get($key);
        return $values;
    }

    private static function fetch_post(string $key) : mixed // --------------------------------------------------------------------------------------
    {
        $value = $_POST[$key];
        if (!isset($value))
            throw new Exception("Required POST parameter \"" . $key . "\" is missing or not set.");
        return $value;
    }

    private static function fetch_get(string $key) : mixed // ---------------------------------------------------------------------------------------
    {
        $value = $_GET[$key];
        if (!isset($value))
            throw new Exception("Required GET parameter \"" . $key . "\" is missing or not set.");
        return $value;
    }
}
?>