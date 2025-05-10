<?php
include "db_connect.php";

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<span style='color: red;'>Username already taken</span>";
    } else {
        echo "<span style='color: green;'>Username available</span>";
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>