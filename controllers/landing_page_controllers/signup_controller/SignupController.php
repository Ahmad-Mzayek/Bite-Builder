<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

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
        self::validate_username($username_input);
        self::validate_email_address($email_address_input);
        $hashed_password = self::validate_password($password_input, $confirm_password_input);
        $user_info = array($username_input, $email_address_input, $hashed_password);
        return $user_info;
    }

    private static function validate_username(string $username_input) : void // ---------------------------------------------------------------------
    {
        self::validate_username_format($username_input);
        $query = self::validate_username_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("s", $username_input);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_unique = $statement->num_rows === 0;
        $statement->close();
        if (!$is_unique)
            throw new Exception("Username already exists.");
    }

    private static function validate_username_format(string $username_input) : void // --------------------------------------------------------------
    {
        $regex = "/^[a-zA-Z0-9_-]+$/";
        if (!preg_match($regex, $username_input))
            throw new Exception("Username can include neither spaces nor special characters except '_' and '-'.");
    }

    private static function validate_username_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM users
            WHERE username = ?;
        SQL;
        return $query;
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

    private static function validate_password(string $password_input, string $confirm_password_input) : string // -----------------------------------
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

    private static function insert_user(array $user_info) : void // ---------------------------------------------------------------------------------
    {
        $user_id = self::insert_dietary_filters();
        [$username, $email_address, $hashed_password] = $user_info;
        $query = self::insert_user_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("isss", $user_id, $username, $email_address, $hashed_password);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function insert_dietary_filters() : int // ---------------------------------------------------------------------------------------
    {
        $query = self::insert_dietary_filters_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $user_id = $statement->insert_id;
        $statement->close();
        return $user_id;
    }

    private static function insert_dietary_filters_query() : string // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            INSERT INTO dietary_filters
            VALUES ();
        SQL;
        return $query;
    }

    private static function insert_user_query() : string // -----------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            INSERT INTO users(user_id, username, email_address, hashed_password)
            VALUES (?, ?, ?, ?);
        SQL;
        return $query;
    }
}
?>