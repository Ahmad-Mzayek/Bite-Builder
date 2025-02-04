<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class UserInfoController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_user_info() : array // --------------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            $user_info = self::fetch_user_info();
            return $user_info;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_user_info() : array // --------------------------------------------------------------------------------------------
    {
        $query = self::fetch_user_info_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result->fetch_assoc();
    }

    private static function fetch_user_info_query() : string // -------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM users
            WHERE user_id = ?
        SQL;
        return $query;
    }
}
?>