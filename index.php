<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config/database.php";

$total_students = 0;

$result = $conn->query(
    "SELECT COUNT(*) AS total FROM students"
);

if ($result) {
    $row = $result->fetch_assoc();
    $total_students = $row['total'];
}


$total_departments = 0;

$result = $conn->query(
    "SELECT COUNT(DISTINCT department) AS total FROM students"
);

if ($result) {
    $row = $result->fetch_assoc();
    $total_departments = $row['total'];
}


$total_male = 0;

$result = $conn->query(
    "SELECT COUNT(*) AS total FROM students WHERE gender='Male'"
);

if ($result) {
    $row = $result->fetch_assoc();
    $total_male = $row['total'];
}


$total_female = 0;

$result = $conn->query(
    "SELECT COUNT(*) AS total FROM students WHERE gender='Female'"
);

if ($result) {
    $row = $result->fetch_assoc();
    $total_female = $row['total'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard - Student Management</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

    <h2>SMS</h2>

    <p>Student Management</p>

    <a href="index.php" class="active">
        Dashboard
    </a>

    <a href="students.php">
        Students
    </a>

    <a href="add_student.php">
        Add Student
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>


<div class="main">

    <div class="topbar">

        <h1>Dashboard</h1>

        <span>
            Welcome, <?php echo $_SESSION['admin']; ?>
        </span>

    </div>


    <div class="cards">

        <div class="card">

            <h3>Total Students</h3>

            <p>
                <?php echo $total_students; ?>
            </p>

        </div>


        <div class="card">

            <h3>Departments</h3>

            <p>
                <?php echo $total_departments; ?>
            </p>

        </div>


        <div class="card">

            <h3>Male Students</h3>

            <p>
                <?php echo $total_male; ?>
            </p>

        </div>


        <div class="card">

            <h3>Female Students</h3>

            <p>
                <?php echo $total_female; ?>
            </p>

        </div>

    </div>


    <div class="dashboard-box">

        <h2>Student Management System</h2>

        <p>
            Manage student records efficiently from one centralized
            dashboard.
        </p>

        <a href="add_student.php" class="btn">
            + Add New Student
        </a>

        <a href="students.php" class="btn secondary">
            View Students
        </a>

    </div>

</div>

</body>

</html>