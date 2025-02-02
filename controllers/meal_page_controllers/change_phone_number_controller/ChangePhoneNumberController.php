<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ChangePhoneNumberController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_phone_number() : void // -----------------------------------------------------------------------------------
    {
        self::$user_id = $_SESSION["user_id"];
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $phone_number_input = self::fetch_phone_number_input();
        self::validate_phone_number($phone_number_input);
        self::change_phone_number($phone_number_input);
        self::$database_connection->close();
    }

    private static function fetch_phone_number_input() : string // ----------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        return $_POST["phone_number_input"];
    }

    private static function validate_phone_number(string $phone_number_input) : void // -------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM users
            WHERE phone_number = ?
              AND user_id != ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("si", $phone_number_input, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_unique = $statement->num_rows() === 0;
        $statement->close();
        if (!$is_unique)
            throw new Exception("Phone number already exists.");
    }

    private static function change_phone_number(string $phone_number_input) : void // ---------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET phone_number = ?
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("si", $phone_number_input, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }
}
?>