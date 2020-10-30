<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <input type="submit" value="Sign in">
        <input type="hidden" name="login" value="login">
        <div><a href="/week07/index.php?action=create_account">Click here to sign up</a></div>
    </form>
</body>
</html>