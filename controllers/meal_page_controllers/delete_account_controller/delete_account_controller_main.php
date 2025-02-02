<?php
header("Content-Type: application/json");

include("./DeleteAccountController.php");

try
{
    DeleteAccountController::handle_delete_account();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>