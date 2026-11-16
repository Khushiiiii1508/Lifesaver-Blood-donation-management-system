<?php
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $requester_name = trim($_POST["requester_name"]);
    $blood_group = $_POST["blood_group"];
    $units_required = (int) $_POST["units_required"];
    $hospital_name = trim($_POST["hospital_name"]);
    $city = trim($_POST["city"]);
    $contact_number = trim($_POST["contact_number"]);
    $urgency = $_POST["urgency"];

    $valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];
    $valid_urgency = ["Normal", "Urgent", "Emergency"];

    if (
        $requester_name == "" ||
        !in_array($blood_group, $valid_groups) ||
        $units_required < 1 ||
        $hospital_name == "" ||
        $city == "" ||
        !preg_match("/^[0-9+\-\s]{7,15}$/", $contact_number) ||
        !in_array($urgency, $valid_urgency)
    ) {
        die("Invalid information. Please check your details.");
    }

    $sql = "INSERT INTO blood_requests
    (requester_name, blood_group, units_required, hospital_name, city, contact_number, urgency)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssissss",
        $requester_name,
        $blood_group,
        $units_required,
        $hospital_name,
        $city,
        $contact_number,
        $urgency
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Blood request submitted successfully!";
        echo "<br><a href='index.php'>Submit another request</a>";
        echo "<br><a href='../index.php'>Go to Home</a>";
    } else {
        echo "Request submission failed. Please try again.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: index.php");
    exit;
}
?>