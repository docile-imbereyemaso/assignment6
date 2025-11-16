<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password_hash'])) {

            // Session fixation prevention
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Optional: Remember Me cookie
            if ($remember) {
                $selector = bin2hex(random_bytes(6));
                $validator = bin2hex(random_bytes(32));
                $expires = date('Y-m-d H:i:s', time() + 86400 * 30); // 30 days

                setcookie("remember", $selector.':'.$validator, time() + 86400*30, "/", "", false, true);

                $validator_hash = hash('sha256', $validator);

                $update = $conn->prepare("UPDATE users SET remember_selector=?, remember_validator_hash=?, remember_expires=? WHERE id=?");
                $update->bind_param("sssi", $selector, $validator_hash, $expires, $user['id']);
                $update->execute();
                $update->close();
            }

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No account found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    Remember Me: <input type="checkbox" name="remember"><br><br>

    <button type="submit">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>

<p>Don't have an account? <a href="register.php">Create an account here</a></p>

</body>
</html>
