<?php
header("Content-Type: application/json");

include("./login_controller_utils.php");

try
{
    $user_id = handle_login();
    start_user_session($user_id);
    send_response("success", "Login successful!");
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>