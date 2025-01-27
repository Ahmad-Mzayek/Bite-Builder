<?php
include("../../global_controllers/global_controllers_utils.php");
include("../../../models/DatabaseConnectionSingleton.php");

$database_connection;

function handle_signup() : void // --------------------------------------------------------------------------------------------
{
    global $database_connection;
    $database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();
    [$username_input, $email_address_input, $password_input] = fetch_input();
    validate_username($username_input);
    validate_email_address($email_address_input);
    $hashed_password = validate_and_hash_password($password_input);
    insert_user_info($username_input, $email_address_input, $hashed_password);
    $database_connection->close();
}

function fetch_input() : array // ---------------------------------------------------------------------------------------------
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST")
        throw new Exception("Invalid request method.");
    $email_address_input = $_POST["email_address_input"];
    $username_input = $_POST["username_input"];
    $password_input = $_POST["password_input"];
    $confirm_password_input = $_POST["confirm_password_input"];
    if (empty($email_address_input) || empty($username_input) || empty($password_input) || empty($confirm_password_input))
        throw new Exception("Credentials cannot be blank.");
    $email_address_pattern = "/^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9])*\@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($email_address_pattern, $email_address_input))
        throw new Exception("Invalid email_address format.");
    if ($password_input != $confirm_password_input)
        throw new Exception("Passwords do not match.");
    return array($username_input, $email_address_input, $password_input);
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
    $statement->store_result();
    $is_unique = $statement->num_rows === 0;
    $statement->close();
    if (!$is_unique)
        throw new Exception("Username already exists.");
}

function validate_email_address(string $email_address_input) : void // --------------------------------------------------------
{
    global $database_connection;
    $query = "SELECT * FROM users WHERE email_address = ?";
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $statement->bind_param("s", $email_address_input);
    execute_statement($statement);
    $is_unique = $statement->num_rows === 0;
    $statement->close();
    if (!$is_unique)
        throw new Exception("Email address already exists.");
}

function validate_and_hash_password(string $password_input) : string // -------------------------------------------------------
{
    if (!preg_match("/[A-Z]/", $password_input))
        throw new Exception("Password must contain at least one uppercase letter.");
    if (!preg_match("/[a-z]/", $password_input))
        throw new Exception("Password must contain at least one lowercase letter.");
    if (!preg_match("/[0-9]/", $password_input))
        throw new Exception("Password must contain at least one digit.");
    if (!preg_match("/[+\-!@#$%^&*(),.?\"\':{}|<>]/", $password_input))
        throw new Exception("Password must contain at least one special character.");
    if (preg_match("/\s/", $password_input))
        throw new Exception("Password must not contain spaces.");
    return hash("sha256", $password_input);
}

function insert_user_info(string $username_input, string $email_address_input, string $hashed_password) : void // -------------
{
    global $database_connection;
    $id = insert_user_diet();
    $query = "INSERT INTO users(id, username, email_address, hashed_password) VALUES (?, ?, ?, ?)";
    $statement = $database_connection->prepare($query);
    if (!$statement)
        throw new Exception("Database query preparation failed: " . $database_connection->error);
    $statement->bind_param("ssss", $id, $username_input, $email_address_input, $hashed_password);
    execute_statement($statement);
    $statement->store_result();
    $statement->close();
}

function insert_user_diet() : int // -----------------------------------------------------------------------------------------
{
    global $database_connection;
    $query = "INSERT INTO dietary_filters VALUES ()";
    if (!$database_connection->query($query))
        throw new Exception("Database query execution failed: " . $database_connection->error);
    return $database_connection->insert_id;
}
?>