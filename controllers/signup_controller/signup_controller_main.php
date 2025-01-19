<?php
include("signup_controller_utils.php");

header("Content-Type: application/json");

try
{
    handle_signup();
    send_response("success", "Signup successful!");
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>