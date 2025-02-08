<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class LoginController
{
    private static mysqli $database_connection;

    public static function handle_login() : void // -------------------------------------------------------------------------------------------------
    {
        try
        {
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$login_input, $password_input] = GlobalController::fetch_post_values(array("login_input", "password_input"));
            $user_info = self::fetch_user_info($login_input);
            if (!$user_info)
                throw new Exception("Incorrect login or password.");
            $hashed_password = $user_info["hashed_password"];
            GlobalController::validate_password($password_input, $hashed_password);
            self::start_session($user_info["user_id"]);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_user_info(string $login_input) : ?array // ------------------------------------------------------------------------
    {
        $query = self::fetch_user_info_query($login_input);
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("s", $login_input);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $user_info = $result && $result->num_rows ? $result->fetch_assoc() : null;
        return $user_info;
    }

    private static function fetch_user_info_query(string $login_input) : string // ------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM users
            WHERE 
        SQL;
        $query .= filter_var($login_input, FILTER_VALIDATE_EMAIL) ? "email_address = ?" : "username = ?";
        return $query;
    }

    private static function start_session(int $user_id): void // ------------------------------------------------------------------------------------
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            if (!session_set_cookie_params([
                "lifetime" => 0,
                "path" => "/",
                "domain" => "",
                "secure" => false,
                "httponly" => true,
                "samesite" => "Strict"
            ]))
                throw new Exception("Failed to set cookie parameters for session.");
            if (!session_start())
                throw new Exception("Failed to start the session.");
            if (!session_regenerate_id(true))
                throw new Exception("Failed to regenerate session ID.");
        }
        $_SESSION["user_id"] = $user_id;
        $_SESSION["last_regeneration"] = time();
    }
}
?>