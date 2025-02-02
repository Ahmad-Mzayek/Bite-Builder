<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ChangePasswordController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_password() : void // ---------------------------------------------------------------------------------------
    {
        self::$user_id = $_SESSION["user_id"];
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $password_input = self::fetch_password_input();
        $hashed_password = self::validate_and_hash_password($password_input);
        self::change_password($hashed_password);
        self::$database_connection->close();
    }
    
    private static function fetch_password_input() : string // --------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        $current_password_input = $_POST["current_password_input"];
        $current_hashed_password = self::fetch_current_hashed_password();
        if (hash("sha256", $current_password_input) != $current_hashed_password)
            throw new Exception("The current password is incorrect.");
        $new_password_input = $_POST["new_password_input"];
        $hashed_password = self::validate_and_hash_password($new_password_input);
        $confirm_new_password_input = $_POST["confirm_new_password_input"];
        if ($new_password_input !== $confirm_new_password_input)
            throw new Exception("Passwords do not match.");
        return $hashed_password;
    }

    private static function validate_and_hash_password(string $password_input) : string // ----------------------------------------------------------
    {
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

    private static function change_password(string $hashed_password) : void // ----------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET hashed_password = ?
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("si", $hashed_password, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function fetch_current_hashed_password() : string // -----------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT hashed_password
            FROM users
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row["hashed_password"];
    }
}
?>