<?php
header("Content-Type: application/json");

try
{
    include("signup_controller_utils.php");
    handle_signup();
    send_response("success", "Signup successful!");
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>