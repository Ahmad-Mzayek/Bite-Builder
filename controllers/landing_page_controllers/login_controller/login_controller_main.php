<?php
header("Content-Type: application/json");

include("./LoginController.php");

try
{
    $user_id = LoginController::handle_login();
    GlobalController::start_user_session($user_id);
    GlobalController::send_response("success", "Login successful!");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>