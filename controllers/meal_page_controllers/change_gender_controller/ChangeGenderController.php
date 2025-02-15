<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class ChangeGenderController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_gender() : void // -----------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$is_male] = GlobalController::fetch_post_values(array("is_male"));
            self::change_gender($is_male);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function change_gender(bool $is_male) : void // ----------------------------------------------------------------------------------
    {
        $query = self::change_gender_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("ii", $is_male, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function change_gender_query() : string // ---------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET is_male = ?
            WHERE user_id = ?;
        SQL;
        return $query;
    }
}
?>