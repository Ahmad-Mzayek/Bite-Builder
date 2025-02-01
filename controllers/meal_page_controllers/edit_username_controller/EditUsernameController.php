<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class EditUsernameController
{
    private static mysqli $database_connection;

    public static function handle_edit_username() : void // -----------------------------------------------------------------------------------------
    {
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $username_input = self::fetch_username_input();
        $current_username = self::fetch_current_username();
        if ($username_input === $current_username)
            return;
        self::validate_username($username_input);
        self::edit_username($username_input);
        self::$database_connection->close();
    }

    private static function fetch_username_input() : string // --------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        return $_POST["username_input"];
    }

    private static function fetch_current_username() : string // ------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT username
            FROM users
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("i", $_SESSION["user_id"]);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row["username"];
    }

    private static function validate_username(string $username_input) : void // ---------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM users
            WHERE username = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("s", $username_input);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_unique = $statement->num_rows === 0;
        $statement->close();
        if (!$is_unique)
            throw new Exception("Username already exists.");
    }

    private static function edit_username(string $username_input) : void // -------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET username = ?, username_last_updated = NOW()
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("si", $username_input, $_SESSION["user_id"]);
        GlobalController::execute_statement($statement);
        $statement->close();
    }
}
?>