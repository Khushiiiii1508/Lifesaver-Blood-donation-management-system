<?php
require_once "../config/db.php";

$blood_group = $_GET["blood_group"] ?? "";
$city = trim($_GET["city"] ?? "");

$valid_groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

if (!in_array($blood_group, $valid_groups) || $city == "") {
    die("Please select a valid blood group and city.");
}

$sql = "SELECT full_name, age, blood_group, phone, city
        FROM donors
        WHERE blood_group = ?
        AND city LIKE ?
        AND availability = 'Available'";

$stmt = mysqli_prepare($conn, $sql);

$city_search = "%" . $city . "%";

mysqli_stmt_bind_param($stmt, "ss", $blood_group, $city_search);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Search Results - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="index.php">Search Again</a>
    </nav>
</header>

<section style="padding:40px 5%;">
    <h1 style="text-align:center; color:#b5121b;">
        Donor Search Results
    </h1>

    <p style="text-align:center; margin:20px;">
        Blood Group: <?php echo htmlspecialchars($blood_group); ?>
        | City: <?php echo htmlspecialchars($city); ?>
    </p>

    <div style="overflow-x:auto;">
        <table border="1" cellpadding="12" cellspacing="0"
               width="100%" style="background:white; border-collapse:collapse;">

            <tr style="background:#b5121b; color:white;">
                <th>Name</th>
                <th>Age</th>
                <th>Blood Group</th>
               
                <th>City</th>
            </tr>

            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($donor = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($donor['full_name']); ?></td>
                        <td><?php echo $donor['age']; ?></td>
                        <td><?php echo htmlspecialchars($donor['blood_group']); ?></td>
                        <td><?php echo htmlspecialchars($donor['city']); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4" style="text-align:center;">
                        No available donors found.
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</section>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>