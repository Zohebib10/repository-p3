<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bericht Bewerken</title>
    <link rel="stylesheet" href="styles.css"> <!-- Verwijs naar je CSS-bestand -->
</head>
<body>
    <div class="container">
        <h2>Bericht Bewerken</h2>
        <form action="edit_message_handler.php" method="post">
            <div class="form-group">
                <label for="message">Bericht:</label>
                <textarea name="message" id="message" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Opslaan</button>
                <a href="index.php">Annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>
