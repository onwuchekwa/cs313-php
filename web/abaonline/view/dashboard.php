<?php 
    $pageTitle = 'Dashboard';
    $pageDescription = "To view business owner's profile and perform other task";
    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/");
    }

    $firstName = $_SESSION['businessOwnerData']['first_name'];
    $lastName = $_SESSION['businessOwnerData']['last_name'];
    $emailAddress = $_SESSION['businessOwnerData']['email_address'];
    $gender = $_SESSION['businessOwnerData']['gender'];
    $contactData = $_SESSION['businessOwnerData']['contact_data'];
    $address = $_SESSION['businessOwnerData']['address'];
    $city = $_SESSION['businessOwnerData']['city'];
    $stateLocated = $_SESSION['businessOwnerData']['state_located'];
    $userName = $_SESSION['businessOwnerData']['user_name'];

    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 
?>

<main>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Profile of <?php echo $firstName . ' '. $lastName; ?>
                </div>
                <div class="card-body">
                <p>You are logged in.</p>
                <ul>
                    <li>Username: <?php echo $userName; ?></li>
                    <li>First Name: <?php echo $firstName; ?></li>
                    <li>Last Name: <?php echo $lastName; ?></li>
                    <li>Email Address: <?php echo $emailAddress; ?></li>
                    <li>Gender: <?php If($gender == 'F') { echo 'Female'; } else { echo 'Male'; } ?></li>
                    <li>Contact Number: <?php echo $contactData; ?></li>
                    <li>Address: <?php echo $address . ', ' . $city . ', ' . $stateLocated; ?></li>
                </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    Business Operations
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>