<?php
function execute_statement(mysqli_stmt $statement) : void // ------------------------------------------------------------------
{
    if (!$statement->execute())
    {
        $error_message = "Database query execution failed: " . $statement->error;
        $statement->close();
        throw new Exception($error_message);
    }
}

function start_user_session(int $id): void // ---------------------------------------------------------------------------------
{
    if (session_status() === PHP_SESSION_NONE)
    {
        session_set_cookie_params([
            "lifetime" => 0,
            "path" => "/",
            "domain" => "",
            "secure" => true,
            "httponly" => true,
            "samesite" => "Strict"
        ]);
        if (!session_start())
            throw new Exception("Failed to start the session.");
        if (!session_regenerate_id(true))
            throw new Exception("Failed to regenerate session ID.");
    }
    $_SESSION["id"] = $id;
    $_SESSION["user_logged_in"] = true;
}

function send_response(string $status, string|array $message) : void // -------------------------------------------------------
{
    $response = ["status" => $status, "message" => $message];
    echo json_encode($response);
}
?>