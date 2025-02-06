<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ChangeUsernameController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_username() : void // ---------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$username_input] = GlobalController::fetch_post_values(array("username_input"));
            $current_username = self::fetch_current_username();
            if ($username_input === $current_username)
                throw new Exception("New username cannot be the same as the old username.");
            self::validate_username($username_input);
            self::change_username($username_input);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_current_username() : string // ------------------------------------------------------------------------------------
    {
        $query = self::fetch_current_username_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row["username"];
    }

    private static function fetch_current_username_query() : string // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT username
            FROM users
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function validate_username(string $username_input) : void // ---------------------------------------------------------------------
    {
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

    private static function validate_username_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM users
            WHERE username = ?;
        SQL;
        return $query;
    }

    private static function change_username(string $username_input) : void // -----------------------------------------------------------------------
    {
        $query = self::change_username_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("si", $username_input, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function change_username_query() : string // -------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET username = ?,
                username_last_changed = NOW()
            WHERE user_id = ?;
        SQL;
        return $query;
    }
}
?>