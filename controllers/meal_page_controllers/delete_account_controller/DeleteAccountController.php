<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class DeleteAccountController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_delete_account() : void // ----------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            self::delete_account();
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function delete_account() : void // ----------------------------------------------------------------------------------------------
    {
        self::delete_from_table("favorites");
        self::delete_from_table("shopping_lists");
        self::delete_from_table("users_meal_categories");
        self::delete_from_table("users");
        self::delete_dietary_filters();
    }

    private static function delete_from_table(string $table_name) : void // -------------------------------------------------------------------------
    {
        $query = self::delete_from_table_query($table_name);
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function delete_from_table_query(string $table_name) : string // -----------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM $table_name
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function delete_dietary_filters() : void // --------------------------------------------------------------------------------------
    {
        $query = self::delete_dietary_filters_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function delete_dietary_filters_query() : string // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM dietary_filters
            WHERE filters_id = ?;
        SQL;
        return $query;
    }
}
?>