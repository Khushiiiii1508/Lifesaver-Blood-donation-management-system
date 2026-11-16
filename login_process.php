<?php
session_start();
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $sql = "SELECT id, full_name, username, password
            FROM admins WHERE username = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin["password"])) {

        session_regenerate_id(true);

        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_name"] = $admin["full_name"];

        header("Location: dashboard.php");
        exit;

    } else {
        echo "Invalid username or password.";
        echo "<br><a href='login.php'>Try Again</a>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: login.php");
    exit;
}
?>