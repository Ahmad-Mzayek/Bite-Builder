<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class MealCardController
{
    private static int $user_id, $meal_id;
    private static mysqli $database_connection;

    public static function handle_card(): array // --------------------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [self::$meal_id] = GlobalController::fetch_post_values(array("meal_id"));
            $meal_info = self::fetch_meal_row();
            $meal_info["recipe"] = self::fetch_recipe();
            $meal_info["is_favorite"] = self::fetch_is_favorite();
            return $meal_info;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_meal_row(): array // ----------------------------------------------------------------------------------------------
    {
        $query = self::fetch_meal_row_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$meal_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $meal_row = $result->fetch_assoc();
        return $meal_row;
    }

    private static function fetch_meal_row_query() : string // --------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM meals
            WHERE meal_id = ?;
        SQL;
        return $query;
    }

    private static function fetch_recipe(): array // ------------------------------------------------------------------------------------------------
    {
        $result = self::fetch_recipe_rows();
        $recipe = array();
        while ($row = $result->fetch_assoc())
            $recipe[] = $row;
        return $recipe;
    }

    private static function fetch_recipe_rows(): mysqli_result // -----------------------------------------------------------------------------------
    {
        $query = "CALL fetch_recipe_rows(?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$meal_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    private static function fetch_is_favorite() : bool // -------------------------------------------------------------------------------------------
    {
        $query = self::fetch_is_favorite_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("ii", self::$user_id, self::$meal_id);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $is_favorite = $statement->num_rows() !== 0;
        $statement->close();
        return $is_favorite;
    }

    private static function fetch_is_favorite_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT 1
            FROM favorites
            WHERE user_id = ?
                AND meal_id = ?;
        SQL;
        return $query;
    }
}
?>