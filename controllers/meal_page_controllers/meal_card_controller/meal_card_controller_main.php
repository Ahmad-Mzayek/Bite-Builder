<?php
header("Content-Type: application/json");

include("./MealCardController.php");

try
{
    $meal_card = MealCardController::handle_card();
    GlobalController::send_response("success", $meal_card);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>