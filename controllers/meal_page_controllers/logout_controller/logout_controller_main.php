<?php
include("./LogoutController.php");

try
{
    LogoutController::handle_logout();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>