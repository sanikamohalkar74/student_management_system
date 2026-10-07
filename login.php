<?php
session_start();

include "config/database.php";

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM admins WHERE username = ? AND password = ?"
    );

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $_SESSION['admin'] = $username;

        header("Location: index.php");
        exit();

    } else {

        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="login-body">

<div class="login-box">

    <h1>Student Management</h1>

    <p class="login-subtitle">Admin Login</p>

    <?php if ($error): ?>

        <div class="error">
            <?php echo $error; ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            placeholder="Enter username"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
            required
        >

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <div class="demo-login">

        <strong>Demo Login</strong>

        <br>

        Username: admin

        <br>

        Password: admin123

    </div>

</div>

</body>
</html>