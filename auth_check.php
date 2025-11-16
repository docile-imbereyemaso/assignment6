<?php
session_start();

// Check session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
