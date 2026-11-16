<?php
session_start();
require_once "../config/db.php";

// Check whether admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

// Count total donors
$donors_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM donors");
$donors = mysqli_fetch_assoc($donors_query)["total"];

// Count total blood requests
$requests_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blood_requests");
$requests = mysqli_fetch_assoc($requests_query)["total"];

// Count pending requests
$pending_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blood_requests WHERE status = 'Pending'");
$pending = mysqli_fetch_assoc($pending_query)["total"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver Admin</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section style="padding:40px 5%;">

    <h1 style="color:#b5121b; text-align:center;">
        Welcome, <?php echo htmlspecialchars($_SESSION["admin_name"]); ?>!
    </h1>

    <p style="text-align:center; margin:15px;">
        Admin Dashboard
    </p>

    <div style="display:flex; justify-content:center; flex-wrap:wrap; gap:25px; margin:40px 0;">

        <div style="background:white; padding:30px; border-radius:10px; text-align:center; min-width:200px; box-shadow:0 4px 12px #ddd;">
            <h2>Total Donors</h2>
            <h1 style="color:#b5121b;"><?php echo $donors; ?></h1>
        </div>

        <div style="background:white; padding:30px; border-radius:10px; text-align:center; min-width:200px; box-shadow:0 4px 12px #ddd;">
            <h2>Total Requests</h2>
            <h1 style="color:#b5121b;"><?php echo $requests; ?></h1>
        </div>

        <div style="background:white; padding:30px; border-radius:10px; text-align:center; min-width:200px; box-shadow:0 4px 12px #ddd;">
            <h2>Pending Requests</h2>
            <h1 style="color:#b5121b;"><?php echo $pending; ?></h1>
        </div>

    </div>

    <div style="text-align:center; margin-top:30px;">
        <a href="../donor/manage.php" class="btn">Manage Donors</a>

        <a href="../requests/manage.php" class="btn">Manage Requests</a>

        <a href="../search/index.php" class="btn">Search Donors</a>
    </div>

</section>

</body>
</html>

<?php mysqli_close($conn); ?>