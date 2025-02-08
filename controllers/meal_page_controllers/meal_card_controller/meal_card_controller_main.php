<?php
include("./MealCardController.php");

try
{
    $meal_info = MealCardController::handle_card();
    GlobalController::send_response("success", $meal_info);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>