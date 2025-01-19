<?php
header("Content-Type: application/json");


try
{
    include("login_controller_utils.php");
    $username = handle_login();
    start_user_session($username);
    send_response("success", "Login successful!");
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>