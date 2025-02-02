<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class DeleteAccountController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_delete_account() : void // ----------------------------------------------------------------------------------------
    {
        self::$user_id = $_SESSION["user_id"];
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        self::delete_account();
        self::$database_connection->close();
    }

    private static function delete_account() : void // ----------------------------------------------------------------------------------------------
    {
        self::delete_from_table("favorites");
        self::delete_from_table("shopping_lists");
        self::delete_from_table("users_meal_categories");
        self::delete_from_table("users");
        self::delete_from_table("dietary_filters");
    }

    private static function delete_from_table(string $table_name) : void // -------------------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM $table_name
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }
}
?>