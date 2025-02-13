<?php
include("./ClearShoppingListController.php");

try
{
    ClearShoppingListController::handle_clear_shopping_list();
    GlobalController::send_response("success", "");
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>