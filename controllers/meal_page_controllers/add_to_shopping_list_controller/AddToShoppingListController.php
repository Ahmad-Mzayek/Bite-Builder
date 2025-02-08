<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class AddToShoppingListController
{
    private static int $user_id, $meal_id;
    private static mysqli $database_connection;

    public static function handle_add_to_shopping_list() : array // ---------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            [self::$meal_id] = GlobalController::fetch_post_values(array("meal_id"));
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            $shopping_list = self::add_to_shopping_list();
            return $shopping_list;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function add_to_shopping_list() : array // ---------------------------------------------------------------------------------------
    {
        return array();
    }
}
?>