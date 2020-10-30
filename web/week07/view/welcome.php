<?php
    if (!$_SESSION['loggedin']) {
        header("location: /week07/index.php?action=account_login");
    }

    $username = $_SESSION['getUserOutcome']['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="/week07/css/style.css">
</head>
<body>
    <h1>Welcome <?php echo $username; ?></h1>
    This is your home page. Click <a href="/week07/index.php?action=logout">here</a> to log out.
</body>
</html>