<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Check if email already exists
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        // ✅ Insert the new user into database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful! Redirecting to login...'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form class="form" method="POST">
        <h2>Create Account</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        
        <!-- Password input with show/hide toggle -->
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span onclick="togglePassword()" 
                  style="position: absolute; right: 10px; top: 12px; cursor: pointer; color: #2575fc;">
                  👁️
            </span>
        </div>

        <button type="submit">Register</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

<!-- Password Show/Hide Script -->
<script>
function togglePassword() {
  const passwordField = document.getElementById('password');
  passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
