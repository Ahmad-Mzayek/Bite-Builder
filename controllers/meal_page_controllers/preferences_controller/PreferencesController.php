<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class PreferencesController
{
    private static bool $is_favorites_checked;
    private static mysqli $database_connection;
    private static array $checked_categories, $checked_filters;
    private static string $sort_by, $order, $searched_meal_name;
    private static int $user_id, $min_nb_calories_per_portion, $max_nb_calories_per_portion,
                       $min_preparation_duration_minutes, $max_preparation_duration_minutes;

    public static function handle_preferences() : array // ------------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            if (!self::$database_connection->begin_transaction())
                throw new Exception("Failed to begin transaction.");
            self::set_preferences();
            self::update_user_filters();
            self::update_user_categories();
            $meal_ids = self::fetch_meal_ids();
            if (!self::$database_connection->commit())
                throw new Exception("Failed to commit transaction.");
            return $meal_ids;
        }
        catch (Exception $exception)
        {
            if (isset(self::$database_connection))
                self::$database_connection->rollback();
            throw $exception;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function set_preferences() : void // ---------------------------------------------------------------------------------------------
    {
        [self::$is_favorites_checked, self::$checked_categories, self::$checked_filters, self::$sort_by, self::$order, self::$searched_meal_name,
         self::$min_nb_calories_per_portion, self::$max_nb_calories_per_portion, self::$min_preparation_duration_minutes,
         self::$max_preparation_duration_minutes] = GlobalController::fetch_post_values(array("is_favorites_checked", "checked_categories",
         "checked_filters", "sort_by", "order", "searched_meal_name", "min_nb_calories_per_portion", "max_nb_calories_per_portion",
         "min_preparation_duration_minutes", "max_preparation_duration_minutes"));
    }

    private static function update_user_filters() : void // -----------------------------------------------------------------------------------------
    {
        self::reset_user_filters();
        self::add_user_filters();
    }

    private static function reset_user_filters() : void // ------------------------------------------------------------------------------------------
    {
        $query = self::reset_user_filters_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function reset_user_filters_query() : string // ----------------------------------------------------------------------------------
    {
        $query = <<<SQL
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
                is_high_protein = FALSE,
                is_keto_friendly = FALSE
            WHERE filters_id = ?;
        SQL;
        return $query;
    }

    private static function add_user_filters() : void // --------------------------------------------------------------------------------------------
    {
        $query = self::add_user_filters_query();
        if (empty($query))
            return;
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function add_user_filters_query() : string // ------------------------------------------------------------------------------------
    {
        if (empty(self::$checked_filters[0]))
            return "";
        $conditions = [];
        foreach (self::$checked_filters as $index => $checked_filter)
            $conditions[] = $checked_filter . " = TRUE";
        $set_filters = implode(", ", $conditions);
        $query = <<<SQL
            UPDATE dietary_filters
            SET $set_filters
            WHERE filters_id = ?;
        SQL;
        return $query;
    }

    private static function update_user_categories() : void // --------------------------------------------------------------------------------------
    {
        self::reset_user_categories();
        if (empty(self::$checked_categories[0]))
            return;
        foreach (self::$checked_categories as $index => $checked_category)
            self::add_user_category($checked_category);
    }

    private static function reset_user_categories() : void // ---------------------------------------------------------------------------------------
    {
        $query = self::reset_user_categories_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function reset_user_categories_query() : string // -------------------------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM users_meal_categories
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function add_user_category(string $checked_category) : void // -------------------------------------------------------------------
    {
        $query = self::add_user_category_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("is", self::$user_id, $checked_category);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function add_user_category_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            INSERT INTO users_meal_categories
            VALUES (?, ?);
        SQL;
        return $query;
    }

    private static function fetch_meal_ids() : array // ---------------------------------------------------------------------------------------------
    {
        $result = self::fetch_meal_ids_result();
        $meal_ids = array();
        while ($row = $result->fetch_assoc())
            $meal_ids[] = $row["meal_id"];
        return $meal_ids;
    }

    private static function fetch_meal_ids_result() : mysqli_result // ------------------------------------------------------------------------------
    {
        $query = "CALL fetch_preferred_meal_ids(?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        self::fetch_meal_ids_result_bind_param($statement);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    private static function fetch_meal_ids_result_bind_param(mysqli_stmt $statement) // -------------------------------------------------------------
    {
        $statement->bind_param("iiiiiisss", self::$user_id, self::$min_nb_calories_per_portion, self::$max_nb_calories_per_portion,
                                            self::$min_preparation_duration_minutes, self::$max_preparation_duration_minutes,
                                            self::$is_favorites_checked, self::$searched_meal_name, self::$sort_by, self::$order);
    }
}
?>