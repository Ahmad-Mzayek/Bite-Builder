<?php
require_once("./SignupController.php");

try
{
    SignupController::handle_signup();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>