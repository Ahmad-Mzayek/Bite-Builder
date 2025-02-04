<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ChangePasswordController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_password() : void // ---------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$current_password_input, $new_password_input, $confirm_new_password_input]
                = GlobalController::fetch_post_values(array("current_password_input", "new_password_input", "confirm_new_password_input"));
            self::validate_current_password($current_password_input);
            $hashed_password = self::validate_new_password($new_password_input, $confirm_new_password_input);
            if ($current_password_input === $new_password_input)
                throw new Exception("New password cannot be the same as the old password.");
            self::change_password($hashed_password);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function validate_current_password(string $current_password_input) : void // -----------------------------------------------------
    {
        $current_hashed_password = self::fetch_current_hashed_password();
        if (hash("sha256", $current_password_input) !== $current_hashed_password)
            throw new Exception("The current password is incorrect.");
    }

    private static function fetch_current_hashed_password() : string // -----------------------------------------------------------------------------
    {
        $query = self::fetch_current_hashed_password_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row["hashed_password"];
    }

    private static function fetch_current_hashed_password_query() : string // -----------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT hashed_password
            FROM users
            WHERE user_id = ?;
        SQL;
        return $query;
    }
    
    private static function validate_new_password(string $new_password_input, string $confirm_new_password_input) : string // -----------------------
    {
        $hashed_password = self::validate_password($new_password_input);
        if ($new_password_input !== $confirm_new_password_input)
            throw new Exception("Passwords do not match.");
        return $hashed_password;
    }

    private static function validate_password(string $password_input) : string // -------------------------------------------------------------------
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
        $query = self::change_password_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("si", $hashed_password, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function change_password_query() : string // -------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET hashed_password = ?
            WHERE user_id = ?;
        SQL;
        return $query;
    }
}
?>