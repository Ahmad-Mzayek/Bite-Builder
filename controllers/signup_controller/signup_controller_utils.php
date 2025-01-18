<?php
include("../../models/DatabaseConnectionSingleton.php");

define("EMAIL_PATTERN", "/^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9])*\@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/");

$database_connection = DatabaseConnectionSingleton::get_instance()->get_connection();

function handle_signup() : void // --------------------------------------------------------------------------------------------
{
    [$username_input, $email_input, $password_input] = fetch_input();
    validate_username($username_input);
    validate_email($email_input);
    $hashed_password = validate_password($password_input);
    $current_date_time = date("Y-m-d H:i:s");
    $query = "INSERT INTO Users (username, email, hashed_password, username_last_updated) VALUES (?, ?, ?, ?)";
    global $database_connection;
    $statement = $database_connection->prepare($query);
    $statement->bind_param("ssss", $username_input, $email_input, $hashed_password, $current_date_time);
    if (!$statement->execute())
        throw new Exception("Unable to register user.");
}

function fetch_input() : array // ---------------------------------------------------------------------------------------------
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST")
        throw new Exception("Invalid request method.");
    $email_input = $_POST["email_input"];
    $username_input = $_POST["username_input"];
    $password_input = $_POST["password_input"];
    $confirm_password_input = $_POST["confirm_password_input"];
    if (!isset($email_input, $username_input, $password_input, $confirm_password_input))
        throw new Exception("Malformed request: Missing credentials.");
    if (!preg_match(EMAIL_PATTERN, $email_input))
        throw new Exception("Invalid email format!");
    if ($password_input != $confirm_password_input)
        throw new Exception("Please make sure your passwords match.");
    return array($username_input, $email_input, $password_input);
}

function validate_username(string $username_input) : void // ------------------------------------------------------------------
{
    global $database_connection;
    $query = "SELECT * FROM Users WHERE username = ?";
    $statement = $database_connection->prepare($query);
    $statement->bind_param("s", $username_input);
    $statement->execute();
    $statement->store_result();
    if ($statement->num_rows > 0)
        throw new Exception("Username already exists!");
}

function validate_email(string $email_input) : void // ------------------------------------------------------------------------
{
    global $database_connection;
    $query = "SELECT * FROM Users WHERE email = ?";
    $statement = $database_connection->prepare($query);
    $statement->bind_param("s", $email_input);
    $statement->execute();
    $statement->store_result();
    if ($statement->num_rows > 0)
        throw new Exception("Email already exists!");
}

function validate_password(string $password_input) : string // ----------------------------------------------------------------
{
    if (strlen($password_input) < 8 || strlen($password_input) > 64)
        throw new Exception("Password must be between 8 and 64 characters long.");
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

function send_response(string $status, string $message) : void // -------------------------------------------------------------
{
    echo json_encode(["status" => $status, "message" => $message]);
}
?>