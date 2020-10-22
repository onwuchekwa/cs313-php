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

<main class="container main-section">
<div class="main-body">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Business Owner Dashboard</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
              <div class="mt-3">
                <h4><?php echo $username; ?></h4>
                <p class="text-muted font-size-sm"><?php echo $city . ', '. $stateLocated; ?></p>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
                <button class="btn btn-outline-primary">Message</button>
              </div>
            </div>
          </div>
        </div>        
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">            
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">First Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $firstName; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Last Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $lastName; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Gender</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php If($gender == 'F') { echo 'Female'; } else { echo 'Male'; } ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $emailAddress; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $contactData; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $address . ', ' . $city . ', ' . $stateLocated; ?>
              </div>
            </div>
          </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>