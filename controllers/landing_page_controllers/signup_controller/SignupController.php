<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class SignupController
{
    private static mysqli $database_connection;

    public static function handle_signup() : void // ------------------------------------------------------------------------------------------------
    {
        try
        {
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            $inputs = GlobalController::fetch_post_values(array("username_input", "email_address_input",
                                                                "password_input", "confirm_password_input"));
            $user_info = self::validate_inputs($inputs);
            self::insert_user($user_info);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function validate_inputs(array $inputs) : array // -------------------------------------------------------------------------------
    {
        [$username_input, $email_address_input, $password_input, $confirm_password_input] = $inputs;
        GlobalController::validate_username(self::$database_connection, $username_input);
        self::validate_email_address($email_address_input);
        $hashed_password = GlobalController::validate_new_password($password_input, $confirm_password_input);
        $user_info = array($username_input, $email_address_input, $hashed_password);
        return $user_info;
    }

    private static function validate_email_address(string $email_address_input) : void // -----------------------------------------------------------
    {
        self::validate_email_address_format($email_address_input);
        $query = self::validate_email_address_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("s", $email_address_input);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_unique = $statement->num_rows === 0;
        $statement->close();
        if (!$is_unique)
            throw new Exception("Email address already exists.");
    }

    private static function validate_email_address_format(string $email_address_input) : void // ----------------------------------------------------
    {
        $regex = "/^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9])*\@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($regex, $email_address_input))
            throw new Exception("Invalid email address format.");
    }

    private static function validate_email_address_query() : string // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM users
            WHERE email_address = ?;
        SQL;
        return $query;
    }

    private static function insert_user(array $user_info) : void // ---------------------------------------------------------------------------------
    {
        $query = "CALL insert_user(?, ?, ?);";
        [$username, $email_address, $hashed_password] = $user_info;
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("sss", $username, $email_address, $hashed_password);
        GlobalController::execute_statement($statement);
        $statement->close();
    }
}
?>