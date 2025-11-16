<?php include "auth_check.php"; ?>
<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Employee Management System</title>
   
</head>
<body>

<header>
    <h1>Welcome to the Employee Management System</h1>
    <p>Hello, <strong><?php echo $_SESSION['username']; ?></strong>! Manage your employees efficiently.</p>
</header>

<div class="container">
    <a href="add_employee.php" class="button">Add Employee</a>
    <a href="view_employees.php" class="button">View All Employees</a>
    <a href="logout.php" class="button logout">Logout</a>

    <div class="stats">
        <h3>System Stats</h3>

        <?php
        // Total employees
        $result = $conn->query("SELECT COUNT(*) AS total FROM employees");
        $row = $result->fetch_assoc();
        echo "<p><strong>Total Employees:</strong> " . $row['total'] . "</p>";

        // Recent 5 employees
        $result = $conn->query("SELECT name, position, department, salary, created_at FROM employees ORDER BY created_at DESC LIMIT 5");
        if ($result->num_rows > 0) {
            echo "<h4>Recently Added Employees:</h4>";
            echo "<table><tr><th>Name</th><th>Position</th><th>Department</th><th>Salary</th><th>Added On</th></tr>";
            while ($emp = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$emp['name']}</td>
                        <td>{$emp['position']}</td>
                        <td>{$emp['department']}</td>
                        <td>{$emp['salary']}</td>
                        <td>{$emp['created_at']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No employees added yet.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
