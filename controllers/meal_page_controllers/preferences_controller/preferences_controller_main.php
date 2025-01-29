<?php
include("./preferences_controller_utils.php");

try
{
    $meals = handle_preferences();
    send_response("success", $meals);
}
catch (Exception $exception)
{
    send_response("error", $exception->getMessage());
}
?>