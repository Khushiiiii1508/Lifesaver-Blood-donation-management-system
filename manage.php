<?php
require_once "../config/db.php";

$sql = "SELECT * FROM donors ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="register.php">Register Donor</a>
    </nav>
</header>

<section class="manage-section">
    <h1 style="text-align:center; color:#b5121b;">
        Registered Donors
    </h1>

    <div style="overflow-x:auto; margin-top:30px;">
        <table border="1" cellpadding="12" cellspacing="0"
               width="100%" style="background:white; border-collapse:collapse;">

            <tr style="background:#b5121b; color:white;">
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>City</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>

            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($donor = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $donor['id']; ?></td>
                        <td><?php echo htmlspecialchars($donor['full_name']); ?></td>
                        <td><?php echo $donor['age']; ?></td>
                        <td><?php echo htmlspecialchars($donor['gender']); ?></td>
                        <td><?php echo htmlspecialchars($donor['blood_group']); ?></td>
                        <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                        <td><?php echo htmlspecialchars($donor['city']); ?></td>
                        <td><?php echo htmlspecialchars($donor['availability']); ?></td>
                        <td>
    <a href="edit.php?id=<?php echo $donor['id']; ?>">Edit</a>
    <a href="delete.php?id=<?php echo $donor['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this donor?');">
   Delete
</a>
</td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="9" style="text-align:center;">
                        No donors registered yet.
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</section>

</body>
</html>

<?php mysqli_close($conn); ?>