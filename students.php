```php
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config/database.php";

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if ($search != "") {

    $stmt = $conn->prepare(
        "SELECT * FROM students
         WHERE student_id LIKE ?
         OR name LIKE ?
         OR email LIKE ?
         OR department LIKE ?
         ORDER BY id DESC"
    );

    $value = "%" . $search . "%";

    $stmt->bind_param(
        "ssss",
        $value,
        $value,
        $value,
        $value
    );

    $stmt->execute();

    $students = $stmt->get_result();

} else {

    $students = $conn->query(
        "SELECT * FROM students ORDER BY id DESC"
    );
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Students - Student Management System</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

/* Student Table */

.table-box {
    background: white;
    padding: 25px;
    border-radius: 10px;
    overflow-x: auto;
}

.student-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.student-table th {
    background: #2563eb;
    color: white;
    padding: 14px 10px;
    text-align: left;
}

.student-table td {
    padding: 14px 10px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
    word-wrap: break-word;
}

/* Separate column widths */

.student-table th:nth-child(1),
.student-table td:nth-child(1) {
    width: 5%;
}

.student-table th:nth-child(2),
.student-table td:nth-child(2) {
    width: 12%;
}

.student-table th:nth-child(3),
.student-table td:nth-child(3) {
    width: 15%;
}

.student-table th:nth-child(4),
.student-table td:nth-child(4) {
    width: 20%;
}

.student-table th:nth-child(5),
.student-table td:nth-child(5) {
    width: 13%;
}

.student-table th:nth-child(6),
.student-table td:nth-child(6) {
    width: 15%;
}

.student-table th:nth-child(7),
.student-table td:nth-child(7) {
    width: 10%;
}

.student-table th:nth-child(8),
.student-table td:nth-child(8) {
    width: 10%;
}

.student-name {
    font-weight: bold;
    white-space: normal;
}

.student-email {
    word-break: break-word;
}

.action-buttons {
    white-space: nowrap;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>SMS</h2>

    <p>Student Management</p>

    <a href="index.php">
        Dashboard
    </a>

    <a href="students.php" class="active">
        Students
    </a>

    <a href="add_student.php">
        Add Student
    </a>

    <a href="logout.php">
        Logout
    </a>

</div>


<!-- MAIN CONTENT -->

<div class="main">

    <div class="topbar">

        <h1>Students</h1>

        <a href="add_student.php" class="btn">
            + Add Student
        </a>

    </div>


    <!-- SEARCH -->

    <div class="search-box">

        <form method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search by name, ID, email or department..."
                value="<?php echo
```
