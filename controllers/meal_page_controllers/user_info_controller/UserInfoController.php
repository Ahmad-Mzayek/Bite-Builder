<?php
require_once("../../GlobalController.php");
require_once("../../../models/DatabaseConnectionSingleton.php");

class UserInfoController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_user_info() : array // --------------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            $user_info = self::fetch_user_row();
            $user_info["shopping_list"] = self::fetch_user_shopping_list();
            $user_info["dietary_filters"] = self::fetch_user_dietary_filters();
            $user_info["meal_categories"] = self::fetch_user_meal_categories();
            return $user_info;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_user_row() : array // ---------------------------------------------------------------------------------------------
    {
        $query = self::fetch_user_row_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result->fetch_assoc();
    }

    private static function fetch_user_row_query() : string // --------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM users
            WHERE user_id = ?
        SQL;
        return $query;
    }

    private static function fetch_user_shopping_list() : array // -----------------------------------------------------------------------------------
    {
        $result = self::fetch_user_shopping_list_result();
        $shopping_list = array();
        while ($row = $result->fetch_assoc())
            $shopping_list[] = $row;
        return $shopping_list;
    }

    private static function fetch_user_shopping_list_result() : mysqli_result // --------------------------------------------------------------------
    {
        $query = "CALL fetch_shopping_list(?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }

    private static function fetch_user_dietary_filters() : array // ---------------------------------------------------------------------------------
    {
        $row = self::fetch_user_dietary_filters_row();
        $columns = array("is_halal", "is_organic", "is_vegan", "is_vegetarian", "is_sugar_free", "is_dairy_free",
                         "is_low_carb", "is_low_calorie", "is_low_sodium", "is_high_protein", "is_keto_friendly");
        $user_filters = array();
        foreach ($columns as $column)
            if ($row[$column])
                $user_filters[] = $column;
        return $user_filters;
    }

    private static function fetch_user_dietary_filters_row() : array // -----------------------------------------------------------------------------
    {
        $query = self::fetch_user_dietary_filters_row_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row;
    }

    private static function fetch_user_dietary_filters_row_query() : string // ----------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT *
            FROM dietary_filters
            WHERE filters_id = ?;
        SQL;
        return $query;
    }

    private static function fetch_user_meal_categories() : array // ---------------------------------------------------------------------------------
    {
        $result = self::fetch_user_meal_categories_result();
        $user_meal_categories = array();
        while ($row = $result->fetch_assoc())
            $user_meal_categories[$row["category_name"]] = $row["is_selected"];
        return $user_meal_categories;
    }

    private static function fetch_user_meal_categories_result() : mysqli_result // ------------------------------------------------------------------
    {
        $query = "CALL fetch_user_meal_categories(?);";
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }
}
?>