<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Registration Successful</h1>
    <p>Thank you! Your child, <?= htmlspecialchars($_GET['name']) ?>, has been successfully registered for the bus service.</p>
    <p>A confirmation email has been sent to your email address.</p>
    <a href="index.php">Return to Home</a>
</body>
</html>
