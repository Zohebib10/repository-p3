<?php


// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de ingevoerde gebruikersnaam en wachtwoord
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Valideer de invoer
    // Voeg hier eventueel meer validatielogica toe

    // Controleer of de gebruikersnaam al bestaat in de database
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Deze gebruikersnaam is al in gebruik. Kies een andere.";
    } else {
        // Hash het wachtwoord
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Voeg de nieuwe gebruiker toe aan de database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "Registratie succesvol. U kunt nu inloggen.";
        } else {
            echo "Er is een fout opgetreden bij de registratie. Probeer het opnieuw.";
        }
    }

    $stmt->close();
    $conn->close();
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
    <form action="register.php" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Registreer">
    </form>
</body>
</html>