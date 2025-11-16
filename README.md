# Employee Management System

A PHP-based Employee Management System with CRUD functionality, authentication, and session/cookie security. This project is developed for **RP Tumba College**, Module: **Develop Backend using PHP (Level 6, Year 2).**

---

## Features
- User registration and login
- Password hashing and verification
- Session-based access control for protected pages
- Optional "Remember Me" functionality using cookies
- CRUD operations for employees:
  - Add Employee
  - Edit Employee
  - Delete Employee
  - View All Employees
- Dashboard with welcome message and links
- Secure authentication and prevention of session fixation
- Data validation and sanitization

---

## Files Included
- `add_employee.php` — Add new employees  
- `auth_check.php` — Checks if user is logged in  
- `dashboard.php` — Main dashboard page  
- `db.php` — Database connection  
- `delete_employee.php` — Delete an employee  
- `edit_employee.php` — Edit employee details  
- `employee_system.sql` — Database export  
- `login.php` — Login page  
- `logout.php` — Logout functionality  
- `register.php` — User registration page  
- `view_employees.php` — View all employees  
- `README.md` — Project documentation  

---

## How Sessions Were Used
- Sessions are started on all protected pages to check if the user is logged in.  
- `auth_check.php` is included on every CRUD page to prevent unauthorized access.  
- Session IDs are regenerated on login to prevent session fixation.  

---

## How Cookies Were Used
- Optional "Remember Me" cookie stores a selector and validator for persistent login.  
- Validator is hashed before saving to the database.  
- Cookie expires after 30 days for security.  

---

## How Authentication is Secured
- Passwords are stored hashed using `password_hash()` (PHP).  
- Prepared statements are used for all database queries to prevent SQL injection.  
- Only logged-in users can access CRUD pages.  
- Input validation and sanitization are applied to all forms.  

---

## How to Run Locally
1. **Install XAMPP**  
   Download and install [XAMPP](https://www.apachefriends.org/) (includes Apache and MySQL).  

2. **Copy project folder**  
   Place the `assignment6` folder into your XAMPP `htdocs` directory:  

C:\xampp\htdocs\assignment6

3. **Start XAMPP services**  
Open the XAMPP Control Panel and start:  
- Apache (for PHP)  
- MySQL (for database)  

4. **Set up the database**  
- Open **phpMyAdmin** at [http://localhost/phpmyadmin](http://127.0.0.1/assignment6)  
- Create a new database called `employee_system`  
- Import `employee_system.sql` from the project folder  

5. **Check database configuration (optional)**  
Open `db.php` and ensure credentials match your local setup:
```php
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP password
$dbname = "employee_system";
Run the application
Open your browser and navigate to:

http://localhost/assignment6/


Use the system
Register a new user or login using existing credentials
Access the dashboard, manage employees (Add/Edit/Delete/View)
Logout when done
Optional: Use “Remember Me” to stay logged in for 30 days
GitHub Repository
https://github.com/docile-imbereyemaso/assignment6