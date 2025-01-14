<?php
include_once 'database.php';  

$response = '';

if (isset($_POST['LOGIN'])) {
    $input = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email =?";
        $stmt = $mysqli->prepare($query);
     } 
     else {
        $query = "SELECT * FROM users WHERE username =?";
        $stmt = $mysqli->prepare($query);
    }

    if ($stmt) {
        
        $stmt->bind_param("s", $input); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_array();
            
            if (password_verify($password, $user['password'])) {
                $response = "Login successful!";
                
                session_start();
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_email'] = $input;
                
                // Sending response
                echo json_encode(['status' => 'success', 'message' => $response]);
                exit;
            } 
            else {
                $response = "Incorrect password!";
                echo json_encode(['status' => 'error', 'message' => $response]);
            }
        } else {
            $response = "No user found!";
            echo json_encode(['status' => 'error', 'message' => $response]);
        }

        $stmt->close();
    } 
    else {
        $response = "Database query error.";
        echo json_encode(['status' => 'error', 'message' => $response]);
    }
}

$conn->close();
?>
