<?php
require('config.php');

// Controleren of het inlogformulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validatie van de ingediende gegevens
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zoek de gebruiker in de database op basis van de gebruikersnaam
    $stmt = $conn->prepare("SELECT id, username, password, is_admin FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Controleer of het ingevoerde wachtwoord overeenkomt met het gehashte wachtwoord in de database
        if (password_verify($password, $user['password'])) {
            // Start de sessie en sla gebruikersgegevens op
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];

            // Redirect naar de startpagina na succesvol inloggen
            header("Location: index.php");
            exit();
        } else {
            $error_msg = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        $error_msg = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <?php if (isset($error_msg)) echo "<p>$error_msg</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <button type="submit">Inloggen</button>
        </div>
    </form>
    <p>Nog geen account? <a href="register.php">Registreer hier</a>.</p>
</body>
</html>