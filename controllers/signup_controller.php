<?php
include('../database.php');

header("Content-Type: application/json");

$response = '';

if($_SERVER["REQUEST_METHOD"] === "POST"){ 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $pattern = "/^[a-zA-Z0-9]+([._%+-]?[a-zA-Z0-9])*\@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/";
    if (preg_match($pattern, $email)) {

        $query = "SELECT * FROM Users WHERE username =?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $response = "Username already exists!";
            echo json_encode([
                'status' => 'error',
                'message' => $response
            ]);
            exit;
        }

        $query = "SELECT * FROM Users WHERE email =?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $response = "Email already exists!";
            echo json_encode([
                'status' => 'error',
                'message' => $response
            ]);
            exit;
        }


        if ($password != $confirmPassword) {
            $response = "Please make sure your passwords match.";
            echo json_encode([
                'status' => 'error',
                'message' => $response
            ]);
            exit;
        }
         else {
            
            $passwordHash = hash('sha256', $password);
            $dateTime = date('Y-m-d H:i:s');

            $query = "INSERT INTO Users (username, email, hashed_password, username_last_updated) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $passwordHash, $dateTime);

            if ($stmt->execute()) {
                $response = "User registered successfully!";
                echo json_encode([
                    'status' => 'success',
                    'message' => $response
                ]);
            } else {
                $response = "Unable to register user.";
                echo json_encode([
                    'status' => 'error',
                    'message' => $response
                ]);
                exit;
            }
        }
    } else {
        $response = "Invalid email format!";
        echo json_encode([
            'status' => 'error',
            'message' => $response]);
            exit;
    }
}
?>
