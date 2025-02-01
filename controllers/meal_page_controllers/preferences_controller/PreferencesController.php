<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class PreferencesController
{
    private static mysqli $database_connection;
    private static bool $is_favorites_checked;
    private static $checked_categories;
    private static $checked_filters;
    private static int $id, $min_nb_portions, $max_nb_portions, $min_nb_calories_per_portion, $max_nb_calories_per_portion;
    private static string $sort_by, $order;

    public static function handle_preferences() : array // ------------------------------------------------------------------------------------------
    {
        self::$id = $_SESSION["id"];
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        self::set_preferences();
        self::update_user_filters();
        self::update_user_categories();
        self::$database_connection->close();
        return array();
    }

    private static function set_preferences() : void // ---------------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        self::$is_favorites_checked = $_POST["is_favorites_checked"];
        self::$checked_categories = $_POST["checked_categories"];
        self::$checked_filters = $_POST["checked_filters"];
        self::$min_nb_portions = $_POST["min_nb_portions"];
        self::$max_nb_portions = $_POST["max_nb_portions"];
        self::$min_nb_calories_per_portion = $_POST["min_nb_calories_per_portion"];
        self::$max_nb_calories_per_portion = $_POST["max_nb_calories_per_portion"];
        self::$sort_by = $_POST["sort_by"];
        self::$order = $_POST["order"];
    }

    private static function update_user_filters() : void // -----------------------------------------------------------------------------------------
    {
        $query = self::reset_user_filters_query() . self::update_user_filters_query();
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $statement->close();
    }

    private static function update_user_categories() : void // --------------------------------------------------------------------------------------
    {
        $query = self::reset_user_categories_query() . self::update_user_filters_query();
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        GlobalController::execute_statement($statement);
        $statement->store_result();
        $statement->close();
    }

    private static function reset_user_filters_query() : string // ----------------------------------------------------------------------------------
    {
        return <<<SQL
            UPDATE dietary_filters
            SET is_halal = FALSE,
                is_organic = FALSE,
                is_vegan = FALSE,
                is_vegetarian = FALSE,
                is_sugar_free = FALSE,
                is_dairy_free = FALSE,
                is_low_carb = FALSE,
                is_low_calorie = FALSE,
                is_low_sodium = FALSE,
                is_hight_protein = FALSE,
                is_keto_friendly = FALSE
            WHERE id = ?;
        SQL;
    }

    private static function update_user_filters_query() : string // ---------------------------------------------------------------------------------
    {
        $conditions = [];
        foreach (self::$checked_filters as $index => $checked_filter)
            $conditions[] = "$checked_filter = TRUE";
        $query = "";
        if (!empty($conditions))
            $query .= "\n\nUPDATE dietary_filters\nSET " . implode(", ", $conditions) . "\nWHERE id = ?;";
        return $query;
    }

    private static function reset_user_categories_query() : string // -------------------------------------------------------------------------------
    {
        return <<<SQL
            DELETE *
            FROM users_meal_categories
            WHERE user_id = ?;
        SQL;
    }

    private static function update_user_categories_query() : string // ------------------------------------------------------------------------------
    {
        $query = "";
        foreach (self::$checked_categories as $index => $checked_category)
            $query .= <<<SQL
                INSERT INTO users_meal_categories(user_id, meal_category_name)
                VALUES (?, $checked_category)
            SQL;
        return $query;
    }
}