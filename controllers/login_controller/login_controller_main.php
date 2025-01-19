<?php
header("Content-Type: application/json");

include("login_controller_utils.php");

try
{
    $username = handle_login();
    start_user_session($username);
    send_response("success", "Login successful!");
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>