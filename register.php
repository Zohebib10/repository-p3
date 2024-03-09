<?php


// Initialiseren van variabelen
$username = $password = "";
$username_error = $password_error = "";

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Valideer de gebruikersnaam
    if (empty($_POST["username"])) {
        $username_error = "Vul uw gebruikersnaam in.";
    } else {
        $username = test_input($_POST["username"]);
        // Controleer of de gebruikersnaam al bestaat in de database
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $username_error = "Deze gebruikersnaam is al in gebruik. Kies een andere.";
        }
        $stmt->close();
    }

    // Valideer het wachtwoord
    if (empty($_POST["password"])) {
        $password_error = "Vul uw wachtwoord in.";
    } else {
        $password = test_input($_POST["password"]);
    }

    // Voeg de nieuwe gebruiker toe aan de database als er geen fouten zijn
    if (empty($username_error) && empty($password_error)) {
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
        $stmt->close();
    }
    $conn->close();
}

// Hulpfunctie om invoer te testen en te beveiligen tegen SQL-injectie en XSS
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_error; ?></span><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <span class="error"><?php echo $password_error; ?></span><br>

        <input type="submit" value="Registreer">
    </form>
</body>