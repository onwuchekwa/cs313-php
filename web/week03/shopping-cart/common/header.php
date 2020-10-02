<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Shopping Cart portal for Sunday Ogbonnaya Onwuchekwa in CSE 341: Web Backend Development II at Brigham Young University - Idaho">
    <meta name="author" content="Sunday Ogbonnaya Onwuchekwa" />
    <title><?php echo "$pageTitle"; ?> | Shopping Cart</title>

    <link href="https://fonts.googleapis.com/css?family=Sriracha%7CVollkorn:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../shopping-cart/css/styles.css">
    <link rel="shortcut icon" href="../shopping-cart/favicon.ico" type="image/x-icon"/>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">        
        <?php include '../shopping-cart/common/navigation.php'; ?>

        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">Shopping Cart</h1>
                <p class="lead"><em>...home of comfort...</em></p>
            </div>
        </div>