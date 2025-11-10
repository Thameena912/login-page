<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Run SQL query
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query ran successfully
    if (!$result) {
        die("Query failed: " . mysqli_error($conn)); // This helps you see SQL errors if any
    }

    // Fetch user data
    $user = mysqli_fetch_assoc($result);

    // Check if user exists and password matches
    if ($user && $password == $user['password']) {
        $_SESSION['username'] = $user['username'];
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
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
    <form class="form" method="POST">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Don’t have an account? <a href="register.php">Register</a></p>
    </form>
</div>
</body>
</html>
