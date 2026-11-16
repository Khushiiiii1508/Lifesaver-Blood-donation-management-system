<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../search/index.php">Find Donors</a>
    </nav>
</header>

<section class="hero">
    <h1>Request Blood</h1>
    <p>Submit a blood request and let us help you find support.</p>

    <form action="submit.php" method="POST">

        <input type="text" name="requester_name"
               placeholder="Requester Name" required>

        <select name="blood_group" required>
            <option value="">Select Blood Group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <input type="number" name="units_required"
               placeholder="Units Required" min="1" required>

        <input type="text" name="hospital_name"
               placeholder="Hospital Name" required>

        <input type="text" name="city"
               placeholder="City" required>

        <input type="tel" name="contact_number"
               placeholder="Contact Number" required>

        <select name="urgency" required>
            <option value="">Select Urgency</option>
            <option value="Normal">Normal</option>
            <option value="Urgent">Urgent</option>
            <option value="Emergency">Emergency</option>
        </select>

        <button type="submit" class="btn">
            Submit Blood Request
        </button>

    </form>
</section>

</body>
</html>