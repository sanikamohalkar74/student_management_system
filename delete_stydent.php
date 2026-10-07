<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config/database.php";

$id = intval($_GET['id']);

$stmt = $conn->prepare(
    "DELETE FROM students WHERE id=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: students.php");

exit();

?>