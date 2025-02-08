<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

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
            self::set_preferences();
            self::update_user_filters();
            self::update_user_categories();
            $meal_ids = self::fetch_meal_ids();
            return $meal_ids;
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
                is_hight_protein = FALSE,
                is_keto_friendly = FALSE
            WHERE user_id = ?;
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
        $conditions = [];
        foreach (self::$checked_filters as $checked_filter)
            $conditions[] = $checked_filter . " = TRUE";
        $query = "";
        if (empty($conditions))
            return $query;
        $set_filters = implode(", ", $conditions);
        $query .= <<<SQL
            UPDATE dietary_filters
            SET $set_filters
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function update_user_categories() : void // --------------------------------------------------------------------------------------
    {
        self::reset_user_categories();
        foreach (self::$checked_categories as $checked_category)
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
            INSERT INTO users_meal_categories(user_id, category_name)
            VALUES (?, ?)
        SQL;
        return $query;
    }

    private static function fetch_meal_ids() : array // ---------------------------------------------------------------------------------------------
    {
        self::create_views();
        $result = self::fetch_filtered_meal_ids();
        $meal_ids = array();
        while ($row = $result->fetch_assoc())
            $meal_ids[] = $row["meal_id"];
        return $meal_ids;
    }

    private static function create_views() : void // ------------------------------------------------------------------------------------------------
    {
        self::create_user_categories_view();
        self::create_meals_view();
        self::create_categorized_meals_view();
        if (self::$is_favorites_checked)
            self::create_favorites_view();
        self::create_favorite_meals_view();
        self::create_meal_filters_view();
        self::create_user_filters_view();
        self::create_filters_view();
    }

    private static function create_user_categories_view() : void // ---------------------------------------------------------------------------------
    {
        $query = self::user_categories_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function user_categories_view_query() : string // --------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW user_categories_view AS
            SELECT category_name
            FROM users_meal_categories
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function create_meals_view() : void // -------------------------------------------------------------------------------------------
    {
        $query = self::meals_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        self::meals_view_bind_param($statement);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function meals_view_query() : string // ------------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW meals_view AS
            SELECT *
            FROM meals
            WHERE nb_calories_per_portion BETWEEN ? AND ?
              AND preparation_duration_minutes BETWEEN ? AND ?
        SQL;
        if (!empty(self::$searched_meal_name))
            $query .= "\n  AND meal_name = ?";
        $query .= ";";
        return $query;
    }

    private static function meals_view_bind_param(mysqli_stmt $statement) : void // -----------------------------------------------------------------
    {
        if (empty(self::$searched_meal_name))
            $statement->bind_param("iiii", self::$min_nb_calories_per_portion, self::$max_nb_calories_per_portion,
                                           self::$min_preparation_duration_minutes, self::$max_preparation_duration_minutes);
        else
            $statement->bind_param("iiiis", self::$min_nb_calories_per_portion, self::$max_nb_calories_per_portion,
                                            self::$min_preparation_duration_minutes, self::$max_preparation_duration_minutes,
                                            self::$searched_meal_name);
    }

    private static function create_categorized_meals_view() : void // -------------------------------------------------------------------------------
    {
        $query = self::categorized_meals_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function categorized_meals_view_query() : string // ------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW categorized_meals_view AS
            SELECT meals_view.*
            FROM meals_view
            JOIN user_categories_view ON meals_view.category_name = user_categories_view.category_name;
        SQL;
        return $query;
    }

    private static function create_favorites_view() : void // ---------------------------------------------------------------------------------------
    {
        $query = self::favorites_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function favorites_view_query() : string // --------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW favorites_view AS
            SELECT meal_id
            FROM favorites
        SQL;
        return $query;
    }

    private static function create_favorite_meals_view() : void // ----------------------------------------------------------------------------------
    {
        $query = self::favorite_meals_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function favorite_meals_view_query() : string // ---------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW favorite_meals_view AS
            SELECT meals_view.*
            FROM meals_view
        SQL;
        if (self::$is_favorites_checked)
            $query .= "\nJOIN favorites_view ON meals_view.meal_id = favorites_view.meal_id";
        $query .= ";";
        return $query;
    }

    private static function create_meal_filters_view() : void // ------------------------------------------------------------------------------------
    {
        $query = self::meal_filters_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function meal_filters_view_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW meal_filters_view AS
            SELECT dietary_filters.*
            FROM dietary_filters
            JOIN favorite_meals_view
              ON favorite_meals_view.meal_id = dietary_filters.filter_id;
        SQL;
        return $query;
    }

    private static function create_user_filters_view() : void // ------------------------------------------------------------------------------------
    {
        $query = self::user_filters_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function user_filters_view_query() : string // -----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            CREATE OR REPLACE VIEW user_filters_view AS
            SELECT *
            FROM dietary_filters
            WHERE filters_id = ?;
        SQL;
        return $query;
    }

    private static function create_filters_view() : void // -----------------------------------------------------------------------------------------
    {
        $query = self::filters_view_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function filters_view_query() : string // ----------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT mf.filters_id
            FROM meal_filters_view AS mf
            JOIN user_filters_view AS uf
              ON (uf.is_halal = FALSE OR mf.is_halal = uf.is_halal)
             AND (uf.is_organic = FALSE OR mf.is_organic = uf.is_organic)
             AND (uf.is_vegan = FALSE OR mf.is_vegan = uf.is_vegan)
             AND (uf.is_vegetarian = FALSE OR mf.is_vegetarian = uf.is_vegetarian)
             AND (uf.is_sugar_free = FALSE OR mf.is_sugar_free = uf.is_sugar_free)
             AND (uf.is_dairy_free = FALSE OR mf.is_dairy_free = uf.is_dairy_free)
             AND (uf.is_low_carb = FALSE OR mf.is_low_carb = uf.is_low_carb)
             AND (uf.is_low_calorie = FALSE OR mf.is_low_calorie = uf.is_low_calorie)
             AND (uf.is_low_sodium = FALSE OR mf.is_low_sodium = uf.is_low_sodium)
             AND (uf.is_high_protein = FALSE OR mf.is_high_protein = uf.is_high_protein)
             AND (uf.is_keto_friendly = FALSE OR mf.is_keto_friendly = uf.is_keto_friendly);
        SQL;
        return $query;
    }

    private static function fetch_filtered_meal_ids() : mysqli_result // ----------------------------------------------------------------------------
    {
        $query = self::fetch_filtered_meal_ids_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        self::fetch_filtered_meal_ids_bind_params($statement);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    private static function fetch_filtered_meal_ids_query() : string // -----------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT m.meal_id
            FROM favorite_meals_view AS m
            JOIN filters_view AS fv
              ON m.meal_id = fv.filters_id
            ORDER BY 
        SQL;
        $query .= self::fetch_filtered_meal_ids_query_sort_order();
        return $query;
    }

    private static function fetch_filtered_meal_ids_query_sort_order() : string // ------------------------------------------------------------------
    {
        $sort_order = <<<SQL
            CASE
                WHEN ? = "meal_name" AND ? = "asc" THEN m.meal_name
                WHEN ? = "meal_name" AND ? = "desc" THEN m.meal_name DESC
                WHEN ? = "nb_portions" AND ? = "asc" THEN m.nb_portions
                WHEN ? = "nb_portions" AND ? = "desc" THEN -m.nb_portions
                WHEN ? = "nb_calories_per_portion" AND ? = "asc" THEN m.nb_calories_per_portion 
                WHEN ? = "nb_calories_per_portion" AND ? = "desc" THEN -m.nb_calories_per_portion 
                WHEN ? = "preparation_duration_minutes" AND ? = "asc" THEN m.preparation_duration_minutes 
                WHEN ? = "preparation_duration_minutes" AND ? = "desc" THEN -m.preparation_duration_minutes
            END;
        SQL;
        return $sort_order;
    }

    private static function fetch_filtered_meal_ids_bind_params(mysqli_stmt $statement) : void // ---------------------------------------------------
    {
        $statement->bind_param("ssssssssssssssss",
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order,
                               self::$sort_by, self::$order);
    }
}