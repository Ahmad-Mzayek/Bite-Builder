<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class EditUsernameController
{
    private static mysqli $database_connection;
    private const MAX_TIME_INTERVAL_MINUTES = 43200; // 30 days.

    public static function handle_edit_username_request() : int // ----------------------------------------------------------------------------------
    {
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $username_last_edited = self::fetch_username_last_edited();
        self::$database_connection->close();
        $current_date_time = new DateTime();
        $elapsed_seconds = $current_date_time->getTimestamp() - $username_last_edited->getTimestamp();
        $elapsed_minutes = floor($elapsed_seconds / 60);
        $minutes_remaining = self::MAX_TIME_INTERVAL_MINUTES - $elapsed_minutes;
        return max(0, $minutes_remaining);
    }

    private static function fetch_username_last_edited() : DateTime // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT username_last_edited
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
        return new DateTime($row["username_last_edited"]);
    }
}
?>
