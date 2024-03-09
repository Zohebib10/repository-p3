<?php
// Include the database configuration from an external file
require 'config.php'; // Adjust the path if config.php is located elsewhere

// Start a new session or resume an existing one
session_start();

// Check if the login form has been submitted
if (isset($_POST["inloggen"])) {
    try {
        // Create a new database connection using the PDO class
        $db = new PDO($dsn, $user, $pass, $options);

        // Sanitize the username input to prevent XSS attacks
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

        // Retrieve the password directly from the POST array and sanitize
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        // Prepare a SQL query to search for the user by username
        $query = $db->prepare("SELECT * FROM kolom WHERE username = :users");

        // Bind the submitted username to the query
        $query->bindParam(":user", $username, PDO::PARAM_STR);

        // Execute the query
        $query->execute();

        // Check if exactly one user was found
        if ($query->rowCount() == 1) {
            // Retrieve the user data
            $result = $query->fetch();

            // Verify if the submitted password matches the hashed password in the database
            if (password_verify($password, $result["password"])) {
                // Store the username in a session variable
                $_SESSION['gebruikers'] = $username;

                // Redirect the user to the welcome page
                header("Location: welkom.php");
                exit(); // Ensure no further code execution after redirection
            } else {
                // Display an error message if the password is incorrect
                echo "Onjuiste gegevens";
            }
        } else {
            // Display an error message if the username is not found
            echo "Onjuiste gegevens";
        }
    } catch (PDOException $e) {
        // Handle any database errors
        die("Error!: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <form action="#" method="post">
        <div>
            <label for="username">kolomnaam:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" name="inloggen" value="Inloggen">
        </div>
    </form>
    <br/>
    <a href="registreren.php">Registreren</a>
</body>
</html>