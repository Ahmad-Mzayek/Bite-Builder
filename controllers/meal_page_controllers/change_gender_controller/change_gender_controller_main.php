<?php
include("./ChangeGenderController.php");

try
{
    ChangeGenderController::handle_change_gender();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>