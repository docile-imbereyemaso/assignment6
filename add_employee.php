<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $position   = $_POST['position'];
    $department = $_POST['department'];
    $salary     = $_POST['salary'];

    $sql = "INSERT INTO employees (name, position, department, salary) 
            VALUES ('$name', '$position', '$department', '$salary')";

    if ($conn->query($sql) === TRUE) {
        $message = "Employee added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>

<h2>Add New Employee</h2>

<form method="POST">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Position:<br>
    <input type="text" name="position" required><br><br>

    Department:<br>
    <input type="text" name="department" required><br><br>

    Salary:<br>
    <input type="number" step="0.01" name="salary" required><br><br>

    <button type="submit">Add Employee</button>
</form>

<p style="color:green;"><?php echo $message; ?></p>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
