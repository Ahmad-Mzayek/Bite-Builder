<?php
require_once("./UserInfoController.php");

try
{
    $user_info = UserInfoController::handle_user_info();
    GlobalController::send_response("success", $user_info);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>