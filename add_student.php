<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config/database.php";

$message = "";

if (isset($_POST['add_student'])) {

    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department = trim($_POST['department']);
    $year = trim($_POST['year']);
    $gender = trim($_POST['gender']);
    $city = trim($_POST['city']);

    $stmt = $conn->prepare(
        "INSERT INTO students
        (student_id, name, email, phone, department, year, gender, city)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssssss",
        $student_id,
        $name,
        $email,
        $phone,
        $department,
        $year,
        $gender,
        $city
    );

    if ($stmt->execute()) {

        header("Location: students.php");

        exit();

    } else {

        $message = "Unable to add student.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Student</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SMS</h2>

<p>Student Management</p>

<a href="index.php">Dashboard</a>

<a href="students.php">Students</a>

<a href="add_student.php" class="active">
Add Student
</a>

<a href="logout.php">Logout</a>

</div>


<div class="main">

<div class="topbar">

<h1>Add New Student</h1>

</div>


<div class="form-box">

<form method="POST">


<label>Student ID</label>

<input
type="text"
name="student_id"
placeholder="Example: CE2024001"
required
>


<label>Full Name</label>

<input
type="text"
name="name"
placeholder="Enter student name"
required
>


<label>Email</label>

<input
type="email"
name="email"
placeholder="student@example.com"
required
>


<label>Phone</label>

<input
type="text"
name="phone"
placeholder="Enter phone number"
>


<label>Department</label>

<select name="department" required>

<option value="">
Select Department
</option>

<option>
Computer Engineering
</option>

<option>
Information Technology
</option>

<option>
Electronics Engineering
</option>

<option>
Mechanical Engineering
</option>

<option>
Civil Engineering
</option>

</select>


<label>Year</label>

<select name="year" required>

<option value="">
Select Year
</option>

<option>First Year</option>

<option>Second Year</option>

<option>Third Year</option>

<option>Final Year</option>

</select>


<label>Gender</label>

<select name="gender">

<option>Male</option>

<option>Female</option>

<option>Other</option>

</select>


<label>City</label>

<input
type="text"
name="city"
placeholder="Enter city"
>


<button
type="submit"
name="add_student"
>
Add Student
</button>


<a href="students.php" class="cancel">
Cancel
</a>

</form>

</div>

</div>

</body>

</html>