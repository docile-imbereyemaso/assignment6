<?php
include "db.php"; // No auth_check here, because new users are not logged in

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $message = "Account created successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
</head>
<body>
<h2>Register</h2>

<form method="POST">
    Username:<br>
    <input type="text" name="username" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<p style="color:green;"><?php echo $message; ?></p>

<!-- Link to login page -->
<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>
