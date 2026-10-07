<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config/database.php";

$id = intval($_GET['id']);

$result = $conn->query(
    "SELECT * FROM students WHERE id=$id"
);

$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}


if (isset($_POST['update_student'])) {

    $student_id = trim($_POST['student_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department = trim($_POST['department']);
    $year = trim($_POST['year']);
    $gender = trim($_POST['gender']);
    $city = trim($_POST['city']);

    $stmt = $conn->prepare(
        "UPDATE students SET
        student_id=?,
        name=?,
        email=?,
        phone=?,
        department=?,
        year=?,
        gender=?,
        city=?
        WHERE id=?"
    );

    $stmt->bind_param(
        "ssssssssi",
        $student_id,
        $name,
        $email,
        $phone,
        $department,
        $year,
        $gender,
        $city,
        $id
    );

    if ($stmt->execute()) {

        header("Location: students.php");

        exit();

    }
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Student</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="sidebar">

<h2>SMS</h2>

<p>Student Management</p>

<a href="index.php">Dashboard</a>

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


<div class="main">

<div class="topbar">

<h1>Edit Student</h1>

</div>


<div class="form-box">

<form method="POST">


<label>Student ID</label>

<input
type="text"
name="student_id"
value="<?php echo htmlspecialchars($student['student_id']); ?>"
required
>


<label>Full Name</label>

<input
type="text"
name="name"
value="<?php echo htmlspecialchars($student['name']); ?>"
required
>


<label>Email</label>

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($student['email']); ?>"
required
>


<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($student['phone']); ?>"
>


<label>Department</label>

<select name="department">

<option
<?php if($student['department']=="Computer Engineering") echo "selected"; ?>
>
Computer Engineering
</option>

<option
<?php if($student['department']=="Information Technology") echo "selected"; ?>
>
Information Technology
</option>

<option
<?php if($student['department']=="Electronics Engineering") echo "selected"; ?>
>
Electronics Engineering
</option>

<option
<?php if($student['department']=="Mechanical Engineering") echo "selected"; ?>
>
Mechanical Engineering
</option>

<option
<?php if($student['department']=="Civil Engineering") echo "selected"; ?>
>
Civil Engineering
</option>

</select>


<label>Year</label>

<select name="year">

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
value="<?php echo htmlspecialchars($student['city']); ?>"
>


<button
type="submit"
name="update_student"
>
Update Student
</button>

</form>

</div>

</div>

</body>

</html>