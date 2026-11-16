<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration - LifeSaver</title>
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
    <h1>Become a Blood Donor</h1>
    <p>Register yourself and become someone's hope.</p>

    <form action="register_process.php" method="POST">

        <input type="text" name="full_name"
               placeholder="Full Name" required>

        <input type="number" name="age"
               placeholder="Age" min="18" max="65" required>

        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

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

        <input type="tel" name="phone"
               placeholder="Phone Number" required>

        <input type="email" name="email"
               placeholder="Email Address">

        <input type="text" name="city"
               placeholder="City" required>

        <button type="submit" class="btn">
            Register as Donor
        </button>

    </form>
</section>

</body>
</html>