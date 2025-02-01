<?php
header("Content-Type: application/json");

include("./EditUsernameController.php");

try
{
    EditUsernameController::handle_edit_username();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>