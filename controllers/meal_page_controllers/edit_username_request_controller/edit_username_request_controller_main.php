<?php
header("Content-Type: application/json");

include("./EditUsernameRequestController.php");

try
{
    EditUsernameRequestController::handle_edit_username_request();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>