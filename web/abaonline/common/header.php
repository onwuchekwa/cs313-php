<?php
    if (isset($_SESSION['loggedin'])){
        $first_name = $_SESSION['businessOwnerData']['first_name'];
        $login_session = $_SESSION['loggedin'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <title><?php echo $pageTitle; ?> | Aba Online Direct</title>

    <link href="https://fonts.googleapis.com/css?family=Sriracha%7CVollkorn:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/abaonline/css/styles.css">
    <link rel="shortcut icon" href="/abaonline/favicon.ico" type="image/x-icon"/>
</head>
<body>
    <div class="wrapper">        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/navigation.php'; ?>