<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class LoginController
{
    private static mysqli $database_connection;

    public static function handle_login() : int // --------------------------------------------------------------------------------------------------
    {
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        [$login_input, $password_input] = self::fetch_input();
        $user_info = self::fetch_user_info($login_input);
        self::$database_connection->close();
        if (!$user_info || !self::validate_password($password_input, $user_info["hashed_password"]))
            throw new Exception("Incorrect username or password.");
        return $user_info["user_id"];
    }

    private static function fetch_input() : array // ------------------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        $login_input = $_POST["login_input"];
        $password_input = $_POST["password_input"];
        return array($login_input, $password_input);
    }

    private static function fetch_user_info(string $login_input) : ?array // ------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM users
            WHERE 
        SQL;
        $query .= filter_var($login_input, FILTER_VALIDATE_EMAIL) ? "email_address = ?" : "username = ?";
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("s", $login_input);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $user_info = $result && $result->num_rows ? $result->fetch_assoc() : null;
        return $user_info;
    }

    private static function validate_password(string $password_input, string $hashed_password) : bool // --------------------------------------------
    {
        return hash("sha256", $password_input) === $hashed_password;
    }
}
?>