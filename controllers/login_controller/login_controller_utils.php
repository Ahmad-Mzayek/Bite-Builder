<?php
include("../../models/DatabaseConnectionSingleton.php");

function handle_login() : string // -------------------------------------------------------------------------------------------
{
    [$login_input, $password_input] = fetch_input();
    $user_info = fetch_user_info($login_input);
    if (!$user_info || !validate_password($password_input, $user_info["hashed_password"]))
        throw new Exception("Incorrect username or password.");
    return $user_info["username"];
}

function fetch_input() : array // ---------------------------------------------------------------------------------------------
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST")
        throw new Exception("Invalid request method.");
    $login_input = trim($_POST["login_input"]);
    $password_input = trim($_POST["password_input"]);
    if (empty($login_input) || empty($password_input))
        throw new Exception("Credentials cannot be blank.");
    return array($login_input, $password_input);
}

function fetch_user_info(string $login_input) : ?array // ---------------------------------------------------------------------
{
    $query = filter_var($login_input, FILTER_VALIDATE_EMAIL)
                ? "SELECT * FROM users WHERE email = ?"
                : "SELECT * FROM users WHERE username = ?";
    $database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $statement->bind_param("s", $login_input);
    execute_statement($statement);
    $result = $statement->get_result();
    $statement->close();
    $user_info = $result && $result->num_rows ? $result->fetch_assoc() : null;
    $database_connection->close();
    return $user_info;
}

function validate_password(string $password_input, string $hashed_password) : bool // -----------------------------------------
{
    return hash("sha256", $password_input) === $hashed_password;
}

function execute_statement(mysqli_stmt $statement) : void // ------------------------------------------------------------------
{
    if (!$statement->execute())
    {
        $error_message = "Database query execution failed: " . $statement->error;
        $statement->close();
        throw new Exception($error_message);
    }
}

function start_user_session(string $username) : void // -----------------------------------------------------------------------
{
    session_start();
    session_regenerate_id(true);
    $_SESSION["username"] = $username;
    $_SESSION["user_logged_in"] = true;
}

function send_response(string $status, string $message) : void // -------------------------------------------------------------
{
    echo json_encode(["status" => $status, "message" => $message]);
}
?>