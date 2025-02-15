<?php
require_once("./SetShoppingListQuantityController.php");

try
{
    SetShoppingListQuantityController::handle_set_shopping_list_quantity();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>