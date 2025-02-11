<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ClearShoppingListController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_clear_shopping_list() : void // -----------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            self::clear_shopping_list();
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function clear_shopping_list() : void // -----------------------------------------------------------------------------------------
    {
        $query = self::clear_shopping_list_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function clear_shopping_list_query() : string // ---------------------------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM shopping_lists
            WHERE user_id = ?;
        SQL;
        return $query;
    }
}
?>