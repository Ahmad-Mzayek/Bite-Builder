<?php
header("Content-Type: application/json");

include("./ChangePhoneNumberController.php");

try
{
    ChangePhoneNumberController::handle_change_phone_number();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>