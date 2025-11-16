<?php include "auth_check.php"; ?>
<?php include "db.php"; ?>

<?php
$sql = "SELECT * FROM employees ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>All Employees</title></head>
<body>
<h2>All Employees</h2>
<p>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></p>

<?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'){ echo "<p style='color:green;'>Employee deleted successfully!</p>"; } ?>

<table border="1" cellpadding="10">
<tr>
<th>ID</th><th>Name</th><th>Position</th><th>Department</th><th>Salary</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['position']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['salary']; ?></td>
<td>
<a href="edit_employee.php?id=<?php echo $row['id']; ?>">Edit</a> |
<a href="delete_employee.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<br><a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
