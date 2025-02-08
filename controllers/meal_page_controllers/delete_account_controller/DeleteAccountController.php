<?php
include("../../GlobalController.php");
include("../../../models/DatabaseConnectionSingleton.php");

class DeleteAccountController
{
    private static int $user_id;
    private static mysqli $database_connection;

    public static function handle_delete_account() : void // ----------------------------------------------------------------------------------------
    {
        try
        {
            GlobalController::resume_session();
            self::$user_id = $_SESSION["user_id"];
            self::$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
            [$password_input] = GlobalController::fetch_post_values(array("password_input"));
            $hashed_password = self::fetch_hashed_password();
            GlobalController::validate_password($password_input, $hashed_password);
            self::delete_account();
        }
        finally
        {
            if (isset(self::$database_connection)) 
                self::$database_connection->close();
        }
    }

    private static function fetch_hashed_password() : string // -------------------------------------------------------------------------------------
    {
        $query = self::fetch_hashed_password_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $result = $statement->get_result();
        $statement->close();
        $row = $result->fetch_assoc();
        return $row["hashed_password"];
    }

    private static function fetch_hashed_password_query() : string // -------------------------------------------------------------------------------
    {
        $query = <<<SQL
            SELECT hashed_password
            FROM users
            WHERE user_id = ?;
        SQL;
        return $query;
    }

    private static function delete_account() : void // ----------------------------------------------------------------------------------------------
    {
        $query = self::delete_account_query();
        $statement = GlobalController::prepare_statement(self::$database_connection, $query);
        $statement->bind_param("i", self::$user_id);
        GlobalController::execute_statement($statement);
        $statement->close();
    }

    private static function delete_account_query() : string // --------------------------------------------------------------------------------------
    {
        $query = <<<SQL
            DELETE FROM dietary_filters
            WHERE filters_id = ?;
        SQL;
        return $query;
    }
}
?>