<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include "db_connect.php";

// Check if connection is successful
if (!$conn) {
    echo "<span style='color: red;'>Database connection failed: " . mysqli_connect_error() . "</span>";
    exit;
}

// Check if email was posted
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Basic validation
    if (empty($email)) {
        echo "<span style='color: red;'>Email cannot be empty</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span style='color: red;'>Invalid email format</span>";
    } else {
        // Prepare query to check email
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if (!$stmt) {
            echo "<span style='color: red;'>Database error: " . mysqli_error($conn) . "</span>";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<span style='color: red;'>Email already registered</span>";
            } else {
                echo "<span style='color: green;'>Email available</span>";
            }
            
            mysqli_stmt_close($stmt);
        }
    }
} else {
    echo "<span style='color: red;'>No email provided</span>";
}

mysqli_close($conn);
?>