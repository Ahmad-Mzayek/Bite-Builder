<?php
include("./AddToShoppingListController.php");

try
{
    $shopping_list = AddToShoppingListController::handle_add_to_shopping_list();
    GlobalController::send_response("success", $shopping_list);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>