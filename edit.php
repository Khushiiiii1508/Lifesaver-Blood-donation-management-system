session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: ../admin/login.php");
    exit();
}
<?php
require_once "../config/db.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid donor ID.");
}

$id = (int) $_GET["id"];

$stmt = mysqli_prepare($conn, "SELECT * FROM donors WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$donor = mysqli_fetch_assoc($result);

if (!$donor) {
    die("Donor not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donor - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="manage.php">Manage Donors</a>
    </nav>
</header>

<section class="hero">
    <h1>Edit Donor Details</h1>

    <form action="update.php" method="POST">

        <input type="hidden" name="id"
               value="<?php echo $donor['id']; ?>">

        <input type="text" name="full_name"
               value="<?php echo htmlspecialchars($donor['full_name']); ?>"
               placeholder="Full Name" required>

        <input type="number" name="age"
               value="<?php echo $donor['age']; ?>"
               min="18" max="65" required>

        <select name="gender" required>
            <?php foreach (["Male", "Female", "Other"] as $gender) { ?>
                <option value="<?php echo $gender; ?>"
                    <?php if ($donor['gender'] == $gender) echo "selected"; ?>>
                    <?php echo $gender; ?>
                </option>
            <?php } ?>
        </select>

        <select name="blood_group" required>
            <?php foreach (["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"] as $group) { ?>
                <option value="<?php echo $group; ?>"
                    <?php if ($donor['blood_group'] == $group) echo "selected"; ?>>
                    <?php echo $group; ?>
                </option>
            <?php } ?>
        </select>

        <input type="tel" name="phone"
               value="<?php echo htmlspecialchars($donor['phone']); ?>"
               required>

        <input type="email" name="email"
               value="<?php echo htmlspecialchars($donor['email'] ?? ''); ?>">

        <input type="text" name="city"
               value="<?php echo htmlspecialchars($donor['city']); ?>"
               required>

        <button type="submit" class="btn">Update Donor</button>

    </form>
</section>

</body>
</html>