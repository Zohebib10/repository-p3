<?php
session_start(); // Start or resume the session

// Check if the session variable for the user exists
if (!isset($_SESSION['gebruikers'])) {
    // If not, redirect to the login page
    header("Location: Inloggen.php");
    exit();
}

$gebruikersnaam = $_SESSION['users']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welkom, <?php echo htmlspecialchars($gebruikersnaam); ?></h1>
    <p>Je bent succesvol ingelogd.</p>
    <?php
    if ($gebruikersnaam == 'admin') {
        echo "<p><a href='wachtwoordwijzigen.php'>Admin kan wachtwoorden wijzigen</a></p>";
    }
    ?>
    <a href="logout.php">Uitloggen</a>
</body>
</html>