<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Fetch user ID from session or hidden form input
    $entered_token = $_POST['token'];
    
    $sql = "SELECT token, expires_at FROM password_reset_tokens WHERE user_id='$user_id' AND expires_at > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($entered_token === $row['token']) {
            echo "Token verified successfully!";
            // Proceed with the next step of registration or password reset
        } else {
            echo "Invalid token!";
        }
    } else {
        echo "No valid token found or token has expired!";
    }

    $conn->close();
}
?>
