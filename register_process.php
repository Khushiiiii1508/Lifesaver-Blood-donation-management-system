<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $age = (int) $_POST["age"];
    $gender = $_POST["gender"];
    $blood_group = $_POST["blood_group"];
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $city = trim($_POST["city"]);

    $valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

    if (
        $full_name == "" ||
        $age < 18 || $age > 65 ||
        $city == "" ||
        !in_array($blood_group, $valid_groups) ||
        !in_array($gender, ["Male", "Female", "Other"]) ||
        !preg_match("/^[0-9+\-\s]{7,15}$/", $phone) ||
        ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL))
    ) {
        die("Invalid information. Please go back and check your details.");
    }

    $sql = "INSERT INTO donors
    (full_name, age, gender, blood_group, phone, email, city)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sisssss",
        $full_name,
        $age,
        $gender,
        $blood_group,
        $phone,
        $email,
        $city
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Donor registered successfully!";
        echo "<br><a href='register.php'>Register another donor</a>";
        echo "<br><a href='../index.php'>Go to Home</a>";
    } else {
        echo "Registration failed. Please try again.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: register.php");
    exit;
}
?>