<?php 
    $pageTitle = 'Dashboard';
    $pageDescription = "To view business owner's profile and perform other task";
    if ($_SESSION['loggedin']) {       
      $firstName = $_SESSION['businessOwnerData']['first_name'];
      $lastName = $_SESSION['businessOwnerData']['last_name'];
      $middleName = $_SESSION['businessOwnerData']['middle_name'];
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 
?>

<main class="container main-section">
  <div class="main-body">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Company</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message']; 
      }
    ?>
    <div class="row mt-3">
      <div class="col-md-4 mb-3">
        <div class="card">          
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle">
              <div class="mt-3">
                <h4><?php echo $companyInfo['company_name']; ?></h4>
                <p class="text-muted font-size-sm"><?php echo $companyInfo['city']. ', ' .$companyInfo['state_located'];; ?></p>
                <a class="btn btn-outline-primary" href="mailto:<?php echo$companyInfo['email_address']; ?>" title="Send me a message">Send a Message</a>
              </div>
            </div>
          </div>
        </div> 
        <div class="card mt-3">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <?php echo $companyInfo['company_summary']; ?>
            </li>
          </ul>
        </div>       
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">            
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Company Information</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $companyInfo['company_full_info']; ?>
              </div>
            </div>
            <hr>                      
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $companyInfo['email_address']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $companyInfo['contact_data']; ?>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Full Address</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <?php echo $companyInfo['address'] . ', ' . $companyInfo['city'] . ', ' . $companyInfo['state_location']; ?>
              </div>
            </div>
            <?php if ($_SESSION['loggedin']) : ?>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Business Owner</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              <?php 
                  if(!empty($middleName))
                    echo $firstName . ' ' . $middleName . ' '. $lastName;
                  else
                    echo $firstName . ' ' . $lastName; 
                ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>