<?php
require_once("./ChangeUsernameRequestController.php");

try
{
    ChangeUsernameRequestController::handle_change_username_request();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>