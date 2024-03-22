<?php
require('config.php');

// Controleren of het registratieformulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validatie van de ingediende gegevens
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Controleer of wachtwoorden overeenkomen
    if ($password != $confirm_password) {
        $error_msg = "Wachtwoorden komen niet overeen.";
    } else {
        // Controleer of de gebruikersnaam al bestaat
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $error_msg = "Gebruikersnaam is al in gebruik.";
        } else {
            // Controleer of het e-mailadres al bestaat
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $error_msg = "E-mailadres is al geregistreerd.";
            } else {
                // Voeg de nieuwe gebruiker toe aan de database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                if ($stmt->execute()) {
                    // Redirect naar de inlogpagina na succesvolle registratie
                    header("Location: login.php");
                    exit();
                } else {
                    $error_msg = "Er is een fout opgetreden. Probeer het later opnieuw.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
</head>
<body>
    <h2>Registratie</h2>
    <?php if (isset($error_msg)) echo "<p>$error_msg</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="email">E-mailadres:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="confirm_password">Bevestig wachtwoord:</label>
            <input type="password" name="confirm_password" required>
        </div>
        <div>
            <button type="submit">Registreren</button>
        </div>
    </form>
    <p>Heb je al een account? <a href="login.php">Log hier in</a>.</p>
</body>
</html>
