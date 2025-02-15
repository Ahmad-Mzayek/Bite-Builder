<?php
require_once("../../GlobalController.php");

class LogoutController
{
    public static function handle_logout() : void // ------------------------------------------------------------------------------------------------
    {
        GlobalController::resume_session();
        $_SESSION = array();
        if (ini_get("session.use_cookies"))
        {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        if (!session_destroy())
            throw new Exception("Failed to destroy the session with id = " . session_id() . ".");
    }
}
?>