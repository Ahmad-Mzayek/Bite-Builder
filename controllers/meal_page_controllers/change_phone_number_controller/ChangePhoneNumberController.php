<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class ChangePhoneNumberController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_phone_number() : void // -----------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$phone_number_input] = GlobalController::fetch_post_values(array("phone_number_input"));
            self::validate_phone_number($phone_number_input);
            self::change_phone_number($phone_number_input);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function validate_phone_number(string $phone_number_input) : void // -------------------------------------------------------------
    {
        self::validate_phone_number_format($phone_number_input);
        $query = self::validate_phone_number_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("si", $phone_number_input, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_unique = $statement->num_rows() === 0;
        $statement->close();
        if (!$is_unique)
            throw new Exception("Phone number already exists.");
    }

    private static function validate_phone_number_format(string $phone_number_input) : void // ------------------------------------------------------
    {
        $regex = "/^\+[0-9]+$/";
        if (!preg_match($regex, $phone_number_input))
            throw new Exception("Invalid phone number format. It must start with a '+' and contain only digits.");
    }

    private static function validate_phone_number_query() : string // -------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM users
            WHERE phone_number = ?
              AND user_id != ?;
        SQL;
        return $query;
    }

    private static function change_phone_number(string $phone_number_input) : void // ---------------------------------------------------------------
    {
        $query = self::change_phone_number_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("si", $phone_number_input, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function change_phone_number_query() : string // ---------------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET phone_number = ?
            WHERE user_id = ?;
        SQL;
        return $query;
    }
}
?>  