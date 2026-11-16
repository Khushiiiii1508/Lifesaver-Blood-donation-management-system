<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: ../admin/login.php");
    exit();
}
require_once "../config/db.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid donor ID.");
}

$id = (int) $_GET["id"];

$sql = "DELETE FROM donors WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: manage.php");
    exit;
} else {
    echo "Unable to delete donor.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>