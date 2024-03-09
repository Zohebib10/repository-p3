<?php
session_start();
session_unset();
// Start of hervat de sessie
// verwijder alle sessievariabelen
session_destroy(); // vernietig de sessie
header("Location: Inloggen.php"); // Omleiden naar de inlogpagina
exit();
?>