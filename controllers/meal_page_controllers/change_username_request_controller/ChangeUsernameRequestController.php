<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class ChangeUsernameRequestController
{
    private static int $user_id;
    private static mysqli $database_connection;
    private const MAX_TIME_INTERVAL_MINUTES = 43200; // 30 days.

    public static function handle_change_username_request() : void // -------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            $username_last_changed = self::fetch_username_last_changed();
            $nb_minutes_remaining = self::compute_nb_minutes_remaining($username_last_changed);
            if ($nb_minutes_remaining > 0)
                throw new Exception(self::build_exception_message($nb_minutes_remaining));
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_username_last_changed() : DateTime // -----------------------------------------------------------------------------
    {
        $query = self::fetch_username_last_changed_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return new DateTime($row["username_last_changed"]);
    }

    private static function fetch_username_last_changed_query() : string // -------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT username_last_changed
            FROM users
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function compute_nb_minutes_remaining(DateTime $username_last_changed) : int // --------------------------------------------------
    {
        $current_date_time = new DateTime();
        $elapsed_nb_seconds = $current_date_time->getTimestamp() - $username_last_changed->getTimestamp();
        $elapsed_nb_minutes = floor($elapsed_nb_seconds / 60);
        $nb_minutes_remaining = self::MAX_TIME_INTERVAL_MINUTES - $elapsed_nb_minutes;
        return $nb_minutes_remaining;
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
