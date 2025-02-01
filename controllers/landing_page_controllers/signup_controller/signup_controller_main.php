<?php
header("Content-Type: application/json");

include("./SignupController.php");

try
{
    SignupController::handle_signup();
    GlobalController::send_response("success", "Signup successful!");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>