<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/week07/css/style.css">
</head>
<body>
    <?php 
        if(isset($message)) {
            echo $message;
        }
    ?>
    <form action="/week07/">
        <label for="username">
            Username <span>*</span>
            <input type="text" name="username" id="username" required>
        </label>
        <label for="password">
            Password <span>*</span>
            <input type="password" name="password" id="password" required>
        </label>
        <label for="confirm_password">
            Confirm Password <span>*</span>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </label>
        <input type="submit" value="Register">
        <input type="hidden" name="register" value="register">
        <div><a href="/week07/index.php?action=account_login">Click here to login</a></div>
    </form>
</body>
</html>