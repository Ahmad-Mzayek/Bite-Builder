<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class MealCardController
{
    private static int $meal_id;
    private static mysqli $database_connection;

    public static function handle_card(): array // --------------------------------------------------------------------------------------------------
    {
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        self::$meal_id = self::fetch_meal_id();
        $meal_row = self::fetch_meal_row();
        $meal_row["recipe"] = self::fetch_recipe();
        self::$database_connection->close();
        return $meal_row;
    }

    private static function fetch_meal_id(): int // -------------------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET")
            throw new Exception("Invalid request method.");
        if (!isset($_GET["meal_id"]))
            throw new Exception("Meal ID is required.");
        return $_GET["meal_id"];
    }

    private static function fetch_meal_row(): array // ----------------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM meals
            WHERE meal_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("i", self::$meal_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result->fetch_assoc();
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
        $query = <<<SQL
            CREATE OR REPLACE VIEW recipes_view AS
            SELECT ingredient_name, quantity
            FROM recipes
            WHERE meal_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("i", $meal_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function create_ingredients_view(): void // --------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW ingredients_view AS
            SELECT recipes_view.quantity, ingredients.*
            FROM recipes_view
            JOIN ingredients ON recipes_view.ingredient_name = ingredients.ingredient_name;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function get_recipe(): mysqli_result // ------------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT ingredients_view.*, measurement_units.unit_name_plural
            FROM ingredients_view
            JOIN measurement_units ON ingredients_view.unit_name_singular = measurement_units.unit_name_singular;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }
}
?>