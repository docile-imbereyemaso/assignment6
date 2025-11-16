<?php
include "auth_check.php";
include "db.php";

if(!isset($_GET['id'])){
    die("No employee ID provided");
}

$id = intval($_GET['id']); // sanitize input

// Fetch employee
$stmt = $conn->prepare("SELECT * FROM employees WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows != 1){
    die("Employee not found");
}

$employee = $result->fetch_assoc();
$message = "";

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $update = $conn->prepare("UPDATE employees SET name=?, position=?, department=?, salary=? WHERE id=?");
    $update->bind_param("sssdi", $name, $position, $department, $salary, $id);
    if($update->execute()){
        $message = "Employee updated successfully!";
    } else {
        $message = "Error: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Employee</title></head>
<body>
<h2>Edit Employee</h2>
<?php if($message) echo "<p style='color:green;'>$message</p>"; ?>
<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $employee['name']; ?>" required><br><br>
    Position: <input type="text" name="position" value="<?php echo $employee['position']; ?>" required><br><br>
    Department: <input type="text" name="department" value="<?php echo $employee['department']; ?>" required><br><br>
    Salary: <input type="number" step="0.01" name="salary" value="<?php echo $employee['salary']; ?>" required><br><br>
    <button type="submit">Update</button>
</form>

<br><a href="view_employees.php">Back to All Employees</a>
</body>
</html>
