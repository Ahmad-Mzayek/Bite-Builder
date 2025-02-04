<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ToggleFavoriteController
{
    private static bool $is_favorite;
    private static int $user_id, $meal_id;
    private static mysqli $database_connection;

    public static function handle_toggle_favorite() : bool // ---------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [self::$meal_id, self::$is_favorite] = GlobalController::fetch_post_values(array("meal_id", "is_favorite"));
            self::toggle_favorite();
            return !self::$is_favorite;
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function toggle_favorite() : void // ---------------------------------------------------------------------------------------------
    {
        $query = self::toggle_favorite_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("ii", self::$user_id, self::$meal_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function toggle_favorite_query() : string // -------------------------------------------------------------------------------------
    {
        return self::$is_favorite ? <<<SQL
            DELETE FROM favorites
            WHERE user_id = ?
              AND meal_id = ?;
        SQL : <<<SQL
            INSERT INTO favorites(user_id, meal_id)
            VALUES (?, ?);
        SQL;
    }
}
?>