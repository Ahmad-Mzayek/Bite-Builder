<?php
require_once("./DeleteAccountController.php");

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