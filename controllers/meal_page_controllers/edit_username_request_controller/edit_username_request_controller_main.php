<?php
header("Content-Type: application/json");

include("./EditUsernameRequestController.php");

try
{
    $minutes_remaining = EditUsernameController::handle_edit_username_request();
    GlobalController::send_response("success", $minutes_remaining);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>