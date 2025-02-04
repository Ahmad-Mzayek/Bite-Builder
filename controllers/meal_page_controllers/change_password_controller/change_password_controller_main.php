<?php
include("./ChangePasswordController.php");

try
{
    ChangePasswordController::handle_change_password();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>