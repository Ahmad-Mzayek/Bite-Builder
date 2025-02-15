<?php
require_once("./PreferencesController.php");

try
{
    $meal_ids = PreferencesController::handle_preferences();
    GlobalController::send_response("success", $meal_ids);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>