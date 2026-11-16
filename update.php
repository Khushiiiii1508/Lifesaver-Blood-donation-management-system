<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) $_POST["id"];
    $full_name = trim($_POST["full_name"]);
    $age = (int) $_POST["age"];
    $gender = $_POST["gender"];
    $blood_group = $_POST["blood_group"];
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $city = trim($_POST["city"]);

    $valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

    if (
        $id <= 0 ||
        $full_name == "" ||
        $age < 18 || $age > 65 ||
        !in_array($gender, ["Male", "Female", "Other"]) ||
        !in_array($blood_group, $valid_groups) ||
        !preg_match("/^[0-9+\-\s]{7,15}$/", $phone) ||
        ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) ||
        $city == ""
    ) {
        die("Invalid information. Please go back and check the details.");
    }

    $sql = "UPDATE donors SET
            full_name = ?,
            age = ?,
            gender = ?,
            blood_group = ?,
            phone = ?,
            email = ?,
            city = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sisssssi",
        $full_name,
        $age,
        $gender,
        $blood_group,
        $phone,
        $email,
        $city,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage.php");
        exit;
    } else {
        echo "Unable to update donor details.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: manage.php");
    exit;
}
?>