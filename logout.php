<?php
session_start();

// Clear session
$_SESSION = array();
session_destroy();

// Clear cookie
setcookie("remember", "", time() - 3600, "/", "", false, true);

header("Location: login.php");
exit();
?>
