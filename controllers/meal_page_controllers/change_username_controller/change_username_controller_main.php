<?php
header("Content-Type: application/json");

include("./ChangeUsernameController.php");

try
{
    ChangeUsernameController::handle_change_username();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>