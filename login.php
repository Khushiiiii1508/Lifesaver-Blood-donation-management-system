<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - LifeSaver</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h2>🩸 LifeSaver</h2>
    <nav>
        <a href="../index.php">Home</a>
    </nav>
</header>

<section class="hero">
    <h1>Admin Login</h1>
    <p>Login to manage the LifeSaver system.</p>

    <form action="login_process.php" method="POST">

        <input type="text" name="username"
               placeholder="Admin Username" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit" class="btn">
            Login
        </button>

    </form>
</section>

</body>
</html>