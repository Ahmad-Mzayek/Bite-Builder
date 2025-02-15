<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class AddToShoppingListController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_add_to_shopping_list() : array // ---------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$meal_id] = GlobalController::fetch_post_values(array("meal_id"));
            self::add_to_shopping_list($meal_id);
            $shopping_list = self::fetch_shopping_list();
            return $shopping_list;
        }
        finally
        {
            if (isset(self::$database_connection))
                self::$database_connection->close();
        }
    }

    private static function add_to_shopping_list(int $meal_id) : void // ----------------------------------------------------------------------------
    {
        $query = "CALL add_to_shopping_list(?, ?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("ii", self::$user_id, $meal_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function fetch_shopping_list() : array // ---------------------------------------------------------------------------------------
    {
        $result = self::fetch_shopping_list_result();
        $shopping_list = array();
        while ($row = $result->fetch_assoc())
            $shopping_list[] = $row;
        return $shopping_list;
    }

    private static function fetch_shopping_list_result() : mysqli_result // ------------------------------------------------------------------------
    {
        $query = "CALL fetch_shopping_list(?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }
}
?>