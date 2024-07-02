<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username='$userName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Check the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
            // Start session and set session variables here
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }

    $conn->close();
}
?>
