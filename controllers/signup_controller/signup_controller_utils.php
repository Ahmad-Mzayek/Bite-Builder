<?php
include("../global/controller_utils.php");
include("../../models/DatabaseConnectionSingleton.php");

define("EMAIL_PATTERN", "/^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9])*\@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/");

$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();

function handle_signup() : void // --------------------------------------------------------------------------------------------
{
    [$username_input, $email_input, $password_input] = fetch_input();
    validate_username($username_input);
    validate_email($email_input);
    $hashed_password = validate_password($password_input);
    insert_user_info($username_input, $email_input, $hashed_password);
    global $database_connection;
    $database_connection->close();
}

function fetch_input() : array // ---------------------------------------------------------------------------------------------
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST")
        throw new Exception("Invalid request method.");
    $email_input = $_POST["email_input"];
    $username_input = $_POST["username_input"];
    $password_input = $_POST["password_input"];
    $confirm_password_input = $_POST["confirm_password_input"];
    if (empty($email_input) || empty($username_input) || empty($password_input) || empty($confirm_password_input))
        throw new Exception("Credentials cannot be blank.");
    if (!preg_match(EMAIL_PATTERN, $email_input))
        throw new Exception("Invalid email format.");
    if ($password_input != $confirm_password_input)
        throw new Exception("Passwords do not match.");
    return array($username_input, $email_input, $password_input);
}

function validate_username(string $username_input) : void // ------------------------------------------------------------------
{
    global $database_connection;
    $query = "SELECT * FROM users WHERE username = ?";
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $statement->bind_param("s", $username_input);
    execute_statement($statement);
    if ($statement->num_rows > 0)
    {
        $statement->close();
        throw new Exception("Username already exists.");
    }
    $statement->close();
}

function validate_email(string $email_input) : void // ------------------------------------------------------------------------
{
    global $database_connection;
    $query = "SELECT * FROM users WHERE email = ?";
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $statement->bind_param("s", $email_input);
    execute_statement($statement);
    if ($statement->num_rows > 0)
    {
        $statement->close();
        throw new Exception("Email already exists.");
    }
    $statement->close();
}

function validate_password(string $password_input) : string // ----------------------------------------------------------------
{
    if (!preg_match("/[A-Z]/", $password_input))
        throw new Exception("Password must contain at least one uppercase letter.");
    if (!preg_match("/[a-z]/", $password_input))
        throw new Exception("Password must contain at least one lowercase letter.");
    if (!preg_match("/[0-9]/", $password_input))
        throw new Exception("Password must contain at least one digit.");
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password_input))
        throw new Exception("Password must contain at least one special character.");
    if (preg_match("/\s/", $password_input))
        throw new Exception("Password must not contain spaces.");
    return hash("sha256", $password_input);
}

function insert_user_info(string $username_input, string $email_input, string $hashed_password) : void // ---------------------
{
    $query = "INSERT INTO users (username, email, hashed_password, username_last_updated) VALUES (?, ?, ?, ?)";
    global $database_connection;
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $current_date_time = date("Y-m-d H:i:s");
    $statement->bind_param("ssss", $username_input, $email_input, $hashed_password, $current_date_time);
    execute_statement($statement);
    $statement->close();
}
?>