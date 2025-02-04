<?php
include("./LoginController.php");

try
{
    LoginController::handle_login();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>