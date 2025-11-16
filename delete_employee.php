<?php include "auth_check.php"; ?>
<?php
include "db.php";
$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_employees.php?msg=deleted");
    exit();
} else {
    echo "Error deleting employee: " . $stmt->error;
}

$stmt->close();
?>
