<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

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
            [self::$meal_id] = GlobalController::fetch_get_values(array("meal_id"));
            $meal_row = self::fetch_meal_row();
            $meal_row["recipe"] = self::fetch_recipe();
            $meal_row["is_favorite"] = self::fetch_is_favorite();
            return $meal_row;
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
        return $result->fetch_assoc();
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
        self::create_recipes_view();
        self::create_ingredients_view();
        $result = self::get_recipe();
        $recipe = array();
        while ($row = $result->fetch_assoc())
            $recipe[] = $row;
        return $recipe;
    }

    private static function create_recipes_view(): void // ------------------------------------------------------------------------------------------
    {
        $query = self::recipes_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", $meal_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function recipes_view_query() : string // ----------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW recipes_view AS
            SELECT ingredient_name, quantity
            FROM recipes
            WHERE meal_id = ?;
        SQL;
        return $query;
    }

    private static function create_ingredients_view(): void // --------------------------------------------------------------------------------------
    {
        $query = self::ingredients_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function ingredients_view_query() : string // ------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW ingredients_view AS
            SELECT ingredients.*, recipes_view.quantity
            FROM recipes_view
            JOIN ingredients ON recipes_view.ingredient_name = ingredients.ingredient_name;
        SQL;
        return $query;
    }

    private static function get_recipe(): mysqli_result // ------------------------------------------------------------------------------------------
    {
        $query = self::recipe_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    private static function recipe_query() : string // ----------------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT ingredients_view.*, measurement_units.unit_name_plural
            FROM ingredients_view
            JOIN measurement_units ON ingredients_view.unit_name_singular = measurement_units.unit_name_singular;
        SQL;
        return $query;
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
