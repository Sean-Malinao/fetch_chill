<?php
session_start();
include "connection.php";

// Ensure POST data exists and handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && 
        !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $user = $con->prepare("SELECT * FROM users WHERE email ='$email'");
        if($user){
            echo json_encode(["message" => "Email Already Exist!"]);
            return;
        }
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $stmt = $con->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        // Execute and check for success
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Registered Successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
        }

        // Close statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required"]);
    }


    // Close connection
    $con->close();
}
?>