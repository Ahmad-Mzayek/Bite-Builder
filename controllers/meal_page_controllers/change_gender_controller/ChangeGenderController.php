<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class ChangeGenderController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_change_gender() : void // -----------------------------------------------------------------------------------------
    {
        self::$user_id = $_SESSION["user_id"];
        self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
        $is_male = self::fetch_is_male_input();
        self::change_gender($is_male);
        self::$database_connection->close();
    }

    private static function fetch_is_male_input() : bool // -----------------------------------------------------------------------------------------
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST")
            throw new Exception("Invalid request method.");
        return $_POST["is_male"];
    }

    private static function change_gender(bool $is_male) : void // ----------------------------------------------------------------------------------
    {
        $query = <<<SQL
            UPDATE users
            SET is_male = ?
            WHERE user_id = ?;
        SQL;
        $statement = self::$database_connection->prepare($query);
        if (!$statement)
            throw new Exception("Database query preparation failed: " . self::$database_connection->error);
        $statement->bind_param("ii", $is_male, self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }
}
?>