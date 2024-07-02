<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $otherName = $_POST['otherName'];
    $employeeNumber = $_POST['employeeNumber'];
    $departmentDescription = $_POST['departmentDescription'];
    $idNo = $_POST['IdNo'];
    $userName = $_POST['UserName'];
    $password = password_hash($_POST['SetPassword'], PASSWORD_BCRYPT); // Hash the password
    $token = generateToken();
    $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

    $sql = "INSERT INTO users (first_name, last_name, other_name, employee_number, department_description, id_no, username, password)
            VALUES ('$firstName', '$lastName', '$otherName', '$employeeNumber', '$departmentDescription', '$idNo', '$userName', '$password')";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id; // Get the ID of the newly inserted user

        $token_sql = "INSERT INTO password_reset_tokens (user_id, token, expires_at)
                      VALUES ('$user_id', '$token', '$expires_at')";
        if ($conn->query($token_sql) === TRUE) {
            // Send the token to the user's email (pseudo-code, implement your email logic)
            $userEmail = "user@example.com"; // Fetch user's email from form or database
            mail($userEmail, "Your Verification Token", "Your token is: $token");
            echo "New record created successfully and token sent!";
        } else {
            echo "Error: " . $token_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function generateToken($length = 6) {
    return bin2hex(random_bytes($length / 2)); // Generate a random token
}
?>
