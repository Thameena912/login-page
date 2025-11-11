<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user by email
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Compare plain passwords
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            echo "<script>alert('✅ Login Successful! Redirecting...');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('❌ Invalid password! Please try again.');</script>";
        }
    } else {
        echo "<script>alert('❌ No user found with that email!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form class="form" method="POST" autocomplete="off">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
        <button type="submit">Login</button>
        <p>Don’t have an account? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>
