<?php
include "connectpdo.php"; // Include database connection details

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID: $id"; // Debugging statement to check if ID is set correctly

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the delete statement
        $sql = "DELETE FROM berichten WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        echo "Record deleted successfully";

        // Redirect back to the main page
        header('Location: index.php');
        exit(); // Make sure to exit after header redirection
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>