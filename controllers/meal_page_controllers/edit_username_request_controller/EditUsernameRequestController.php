<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class EditUsernameRequestController
{
    private static mysqli $database_connection;
    private const MAX_TIME_INTERVAL_MINUTES = 43200; // 30 days.

    public static function handle_edit_username_request() : void // ---------------------------------------------------------------------------------
    {
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $username_last_edited = self::fetch_username_last_edited();
        self::$database_connection->close();
        $current_date_time = new DateTime();
        $elapsed_nb_seconds = $current_date_time->getTimestamp() - $username_last_edited->getTimestamp();
        $elapsed_nb_minutes = floor($elapsed_nb_seconds / 60);
        $nb_minutes_remaining = self::MAX_TIME_INTERVAL_MINUTES - $elapsed_nb_minutes;
        if ($nb_minutes_remaining > 0)
            throw new Exception(self::build_exception_message($nb_minutes_remaining));
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

    private static function build_exception_message(int $nb_minutes_remaining) : string // ----------------------------------------------------------
    {
        $nb_days_remaining = floor($nb_minutes_remaining / 1440);
        $nb_minutes_remaining %= 1440;
        $nb_hours_remaining = floor($nb_minutes_remaining / 60);
        $nb_minutes_remaining %= 60;
        $parts = array();
        if ($nb_days_remaining > 0)
            $parts[] = $nb_days_remaining . " day" . ($nb_days_remaining > 1 ? "s" : "");
        if ($nb_hours_remaining > 0)
            $parts[] = $nb_hours_remaining . " hour" . ($nb_hours_remaining > 1 ? "s" : "");
        if ($nb_minutes_remaining > 0)
            $parts[] = $nb_minutes_remaining . " minute" . ($nb_minutes_remaining > 1 ? "s" : "");
        return "You cannot change your username until " . implode(", ", $parts) . " later.";
    }
}
?>
