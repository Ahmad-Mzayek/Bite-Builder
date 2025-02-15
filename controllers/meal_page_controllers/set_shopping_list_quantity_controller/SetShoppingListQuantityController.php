<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class SetShoppingListQuantityController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_set_shopping_list_quantity() : void // ----------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$ingredient_name, $new_quantity] = GlobalController::fetch_post_values(array("ingredient_name", "new_quantity"));
            self::set_shopping_list_quantity($ingredient_name, $new_quantity);
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function set_shopping_list_quantity(string $ingredient_name, int $new_quantity) : void // ----------------------------------------
    {
        $query = self::set_shopping_list_quantity_query($new_quantity);
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("is", self::$user_id, $ingredient_name);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function set_shopping_list_quantity_query(int $new_quantity) : string // ---------------------------------------------------------
    {
        $query = $new_quantity > 0 ? "UPDATE shopping_lists\nSET quantity = $new_quantity" : "DELETE FROM shopping_lists";
        $query .= "\nWHERE user_id = ?\n\tAND ingredient_name = ?;";
        return $query;
    }
}
?>