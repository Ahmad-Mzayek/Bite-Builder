<?php
header("Content-Type: application/json");

include("./signup_controller_utils.php");

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