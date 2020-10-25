<?php 
    $pageTitle = 'Delete Business Owner';
    $pageDescription = 'To delete a business, you must have an account with us and logged into it.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/");
    }

    $firstName = $_SESSION['businessOwnerData']['first_name'];
    $lastName = $_SESSION['businessOwnerData']['last_name'];
    $middleName = $_SESSION['businessOwnerData']['middle_name'];
    $emailAddress = $_SESSION['businessOwnerData']['email_address'];
    $gender = $_SESSION['businessOwnerData']['gender'];
    $contactData = $_SESSION['businessOwnerData']['contact_data'];
    $address = $_SESSION['businessOwnerData']['address'];
    $city = $_SESSION['businessOwnerData']['city'];
    $stateLocated = $_SESSION['businessOwnerData']['state_located'];
    $userName = $_SESSION['businessOwnerData']['user_name'];
    $businessOwnerId = $_SESSION['businessOwnerData']['business_owner_id'];
    $contactId = $_SESSION['businessOwnerData']['contact_detail_id'];
    $addressId = $_SESSION['businessOwnerData']['address_detail_id'];
?>

<main class="container main-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item"><a href="/abaonline/actions/" title="return to dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delete my Profile</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Delete <?php if(isset($firstName)){echo $firstName. ' '. $lastName;} ?>
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <p class='bg-danger p-3 text-white'>This action will delete the business owner information and related companies. Are you sure you want to proceed with this action because it cannot be undone?</p>
                        <div class="form-group row">
                            <label for="firstName" class="col-sm-4 col-form-label">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" readonly <?php if(isset($firstName)){echo "value='$firstName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middleName" class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name" readonly <?php if(isset($middleName)){echo "value='$middleName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastName" class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" readonly <?php if(isset($lastName)){echo "value='$lastName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" readonly <?php if(isset($emailAddress)){echo "value='$emailAddress'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender" readonly <?php if (isset($gender) && $gender == "F") echo "value='Female'"; else echo "value='Male'";?>>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="contactData" class="col-sm-4 col-form-label">Contact</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="contactData" name="contactData" placeholder="Contact Details" readonly <?php if(isset($contactData)){echo "value='$contactData'";} ?>>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" readonly <?php if(isset($address)){echo "value='$address'";} ?>>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" readonly <?php if(isset($city)){echo "value='$city'";} ?>>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="stateLocated" class="col-sm-4 col-form-label">State</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="stateLocated" name="stateLocated" placeholder="State" readonly <?php if(isset($stateLocated)){echo "value='$stateLocated'";} ?>>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Delete my Profile" class="btn btn-primary">
                                <input type="hidden" name="action" value="delete-owner"> 
                                <input type="hidden" name="userName" value="<?php if(isset($businessOwnerData['user_name'])){ echo $businessOwnerData['user_name'];} elseif(isset($userName)){ echo $userName; } ?>">
                                <input type="hidden" name="businessOwnerId" value="<?php if(isset($businessOwnerData['business_owner_id'])){ echo $businessOwnerData['business_owner_id'];} elseif(isset($businessOwnerId)){ echo $businessOwnerId; } ?>">
                                <input type="hidden" name="addressId" value="<?php if(isset($businessOwnerData['address_detail_id'])){ echo $businessOwnerData['address_detail_id'];} elseif(isset($addressId)){ echo $addressId; } ?>">
                                <input type="hidden" name="contactId" value="<?php if(isset($businessOwnerData['contact_detail_id'])){ echo $businessOwnerData['contact_detail_id'];} elseif(isset($contactId)){ echo $contactId; } ?>">
                            </div>
                        </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>