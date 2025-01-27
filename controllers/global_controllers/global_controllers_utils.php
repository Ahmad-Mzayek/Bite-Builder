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

function start_user_session(string $username) : void // -----------------------------------------------------------------------
{
    session_start();
    session_regenerate_id(true);
    $_SESSION["username"] = $username;
    $_SESSION["user_logged_in"] = true;
}

function send_response(string $status, string $message) : void // -------------------------------------------------------------
{
    $response = ["status" => $status, "message" => $message];
    echo json_encode($response);
}
?>