<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: ../admin/login.php");
    exit();
}
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];
    $status = $_POST["status"];

    $valid_status = ["Pending", "Approved", "Completed", "Cancelled"];

    if ($id <= 0 || !in_array($status, $valid_status)) {
        die("Invalid request information.");
    }

    $sql = "UPDATE blood_requests SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage.php");
        exit;
    } else {
        echo "Unable to update request status.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: manage.php");
    exit;
}
?>