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

    public static function validate_password(string $password_input, string $confirm_password_input) : string // ------------------------------------
    {
        if ($password_input !== $confirm_password_input)
            throw new Exception("Passwords do not match.");
        if (!preg_match("/[A-Z]/", $password_input))
            throw new Exception("Password must contain at least one uppercase letter.");
        if (!preg_match("/[a-z]/", $password_input))
            throw new Exception("Password must contain at least one lowercase letter.");
        if (!preg_match("/[0-9]/", $password_input))
            throw new Exception("Password must contain at least one digit.");
        if (!preg_match("/[+\-!@#$%^&*(),.?\"\':{}|<>]/", $password_input))
            throw new Exception("Password must contain at least one special character.");
        if (preg_match("/\s/", $password_input))
            throw new Exception("Password must not contain spaces.");
        return hash("sha256", $password_input);
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

    private static function fetch_post(string $key) : mixed // --------------------------------------------------------------------------------------
    {
        $value = $_POST[$key];
        if (!isset($value))
            throw new Exception("Required POST parameter \"" . $key . "\" is missing or not set.");
        return $value;
    }
}
?>