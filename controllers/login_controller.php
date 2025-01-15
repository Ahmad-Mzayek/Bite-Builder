<?php
include('../database.php');  

header("Content-Type: application/json");

$response = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (empty($input) || empty($password)) {
        echo json_encode([
            'status' => 'error',
            'message' => "Credentials cannot be blank!"
        ]);
        exit;
    }
       

    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($query);
     } 
     else {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $mysqli->prepare($query);
    }

    if ($stmt) {
        
        $stmt->bind_param("s", $input); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_array();

            if (hash('sha256',$password) === $user['hashed_password']) {
                $response = "Login successful!";
                session_start();
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_email'] = $input;
                
                // Sending response
                echo json_encode([
                    'status' => 'success',
                    'message' => $response
                    ]);
                exit;
            } 
            else {
                $response = "Incorrect username or password!";
                echo json_encode([
                    'status' => 'error',
                    'message' => $response]);
                exit;
            }
        } else {
            $response = "Incorrect username or password.";
            echo json_encode([
                'status' => 'error',
                'message' => $response
            ]);
            exit;
        }

        $stmt->close();
    } 
    else {
        $response = "Database query error.";
        echo json_encode([
        'status' => 'error',
        'message' => $response
        ]);
        exit;
    }
}

$mysqli->close();
?>
