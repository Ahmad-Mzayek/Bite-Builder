<?php
require_once("./ToggleFavoriteController.php");

try
{
    $is_favorite = ToggleFavoriteController::handle_toggle_favorite();
    GlobalController::send_response("success", $is_favorite);
}
catch (Exception $exception)
{
    GlobalController::send_response("error", $exception->getMessage());
}
?>