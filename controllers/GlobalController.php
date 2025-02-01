<?php
class GlobalController
{
    public static function execute_statement(mysqli_stmt $statement) : void // ----------------------------------------------------------------------
    {
        if (!$statement->execute())
        {
            $error_message = "Database query execution failed: " . $statement->error;
            $statement->close();
            throw new Exception($error_message);
        }
    }

    public static function start_user_session(int $user_id): void // --------------------------------------------------------------------------------
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_set_cookie_params([
                "lifetime" => 0,
                "path" => "/",
                "domain" => "",
                "secure" => true,
                "httponly" => true,
                "samesite" => "Strict"
            ]);
            if (!session_start())
                throw new Exception("Failed to start the session.");
            if (!session_regenerate_id(true))
                throw new Exception("Failed to regenerate session ID.");
        }
        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_logged_in"] = true;
    }

    public static function send_response(string $status, string|array $message) : void // -----------------------------------------------------------
    {
        $response = ["status" => $status, "message" => $message];
        echo json_encode($response);
    }
}
?>