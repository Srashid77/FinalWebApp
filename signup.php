<?php
// Add error reporting at the top of the script
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";
session_start();

$error = '';
$success = '';

// Debug: Check database connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Collect form data
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $gender = validate($_POST['gender']);

    // Validation checks
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || 
        empty($firstname) || empty($lastname) || empty($gender)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Debug: Print out prepared statement details
        $check_username_sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $check_username_sql);
        
        if (!$stmt) {
            $error = "Prepare statement failed: " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $error = "Username already exists. Please choose another.";
            } else {
                // Check if email exists
                $check_email_sql = "SELECT * FROM users WHERE email = ?";
                $email_stmt = mysqli_prepare($conn, $check_email_sql);
                
                if (!$email_stmt) {
                    $error = "Prepare statement failed: " . mysqli_error($conn);
                } else {
                    mysqli_stmt_bind_param($email_stmt, "s", $email);
                    mysqli_stmt_execute($email_stmt);
                    $email_result = mysqli_stmt_get_result($email_stmt);
                    
                    if (mysqli_num_rows($email_result) > 0) {
                        $error = "Email already registered. Please use another email.";
                    } else {
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Prepare SQL to insert new user
                        $insert_sql = "INSERT INTO users (username, email, password, firstname, lastname, gender) VALUES (?, ?, ?, ?, ?, ?)";
                        $insert_stmt = mysqli_prepare($conn, $insert_sql);

                        if (!$insert_stmt) {
                            $error = "Insert prepare failed: " . mysqli_error($conn);
                        } else {
                            mysqli_stmt_bind_param($insert_stmt, "ssssss", $username, $email, $hashed_password, $firstname, $lastname, $gender);
                            
                            if (mysqli_stmt_execute($insert_stmt)) {
                                $success = "Registration successful! You can now login.";
                                $_SESSION['name'] = $username;
                            } else {
                                $error = "Registration failed: " . mysqli_error($conn);
                            }

                            mysqli_stmt_close($insert_stmt);
                        }
                    }
                    mysqli_stmt_close($email_stmt);
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Integrated Health Monitoring System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Sign Up for <i>Integrated Health Monitoring System</i></h3>
            </div>
            <div class="card-body">
                <?php 
                if (!empty($error)) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                }
                if (!empty($success)) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($success) . "</div>";
                }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- First Name Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                    </div>
                    
                    <!-- Last Name Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
                    </div>
                    
                    <!-- Gender Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                        </div>
                        <select class="form-control" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Username Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                    <div id="username-availability" style="margin-bottom: 10px; margin-left: 40px; font-size: 14px;"></div>
                    
                    <!-- Email Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div id="email-availability" style="margin-bottom: 10px; margin-left: 40px; font-size: 14px;"></div>
                    
                    <!-- Password Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Sign Up" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Already have an account? <a href="login.php">Login</a>  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>scripts.js</script> -->

<script>
$(document).ready(function() {
    // Variables to store timeout
    let usernameTypingTimer;
    let emailTypingTimer;
    const doneTypingInterval = 500; // Time in ms (half a second)
    
    // Get references to inputs
    const usernameInput = $('input[name="username"]');
    const emailInput = $('input[name="email"]');
    
    // For username checking
    usernameInput.on('keyup', function() {
        clearTimeout(usernameTypingTimer);
        if (usernameInput.val()) {
            usernameTypingTimer = setTimeout(function() {
                checkUsernameAvailability();
            }, doneTypingInterval);
        } else {
            $('#username-availability').html('');
        }
    });
    
    usernameInput.on('blur', function() {
        if (usernameInput.val()) {
            checkUsernameAvailability();
        }
    });
    
    // For email checking
    emailInput.on('keyup', function() {
        clearTimeout(emailTypingTimer);
        if (emailInput.val()) {
            emailTypingTimer = setTimeout(function() {
                checkEmailAvailability();
            }, doneTypingInterval);
        } else {
            $('#email-availability').html('');
        }
    });
    
    emailInput.on('blur', function() {
        if (emailInput.val()) {
            checkEmailAvailability();
        }
    });
    
    // Function to check username availability
    function checkUsernameAvailability() {
        const username = usernameInput.val().trim();
        
        if (username.length > 0) {
            $('#username-availability').html('<span style="color: blue;">Checking...</span>');
            
            $.ajax({
                url: 'check_username.php',
                type: 'post',
                data: {username: username},
                success: function(response) {
                    $('#username-availability').html(response);
                },
                error: function(xhr, status, error) {
                    $('#username-availability').html('<span style="color: red;">Error checking username</span>');
                    console.error('AJAX error:', status, error);
                }
            });
        } else {
            $('#username-availability').html('');
        }
    }
    
    // Function to check email availability
    function checkEmailAvailability() {
        const email = emailInput.val().trim();
        
        if (email.length > 0) {
            $('#email-availability').html('<span style="color: blue;">Checking...</span>');
            
            $.ajax({
                url: 'check_email.php',
                type: 'post',
                data: {email: email},
                success: function(response) {
                    $('#email-availability').html(response);
                },
                error: function(xhr, status, error) {
                    $('#email-availability').html('<span style="color: red;">Error checking email</span>');
                    console.error('AJAX error:', status, error);
                }
            });
        } else {
            $('#email-availability').html('');
        }
    }
});
</script>

</body>
</html>