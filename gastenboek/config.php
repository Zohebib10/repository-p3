<?php
// Databaseconfiguratie
$servername = "localhost";
$username = "root";
$password = ""; // Voeg hier je MySQL-wachtwoord toe als je er een hebt
$dbname = "gastenboek";

// Aanmeldgegevens
define('ADMIN_USERNAME', 'admin'); // Stel hier de gebruikersnaam van de beheerder in
define('ADMIN_PASSWORD', 'admin123'); // Stel hier het wachtwoord van de beheerder in

// Andere configuratievariabelen
define('SITE_URL', 'http://localhost/gastenboek/'); // URL van je gastenboeksite

// Verbinding maken met de database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Verbindingsfout: " . $e->getMessage());
}
?>
