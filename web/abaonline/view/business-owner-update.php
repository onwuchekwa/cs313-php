<?php 
    $pageTitle = 'Edit Business Owner';
    $pageDescription = 'To edit a business, you must have an account with us and logged into it.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/");
    }

    $contactInfo = getContactInfo($reference_id);
    $addressInfo = getAddressInfo($reference_id);

    $addressList = getAddressType();
    $contactList = getContactType();

    print_r(getAddressType());
    print_r(getAddressInfo($reference_id));
    exit;

    $bindAddressList = buildAddressTypeList($addressList);
    $bindContactList = buildContactTypeList($contactList);

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
        <li class="breadcrumb-item active" aria-current="page">Edit my Profile</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Edit <?php if(isset($firstName)){echo $firstName. ' '. $lastName;} ?>
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <div class="form-group row">
                            <label for="firstName" class="col-sm-4 col-form-label">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required <?php if(isset($firstName)){echo "value='$firstName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middleName" class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name" <?php if(isset($middleName)){echo "value='$middleName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastName" class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" required <?php if(isset($lastName)){echo "value='$lastName'";} ?>>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="F" <?php if (isset($gender) && $gender == "F") echo "checked";?> checked>
                                        <label class="form-check-label" for="genderFemale">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="M" <?php if (isset($gender) && $gender == "M") echo "checked";?>>
                                        <label class="form-check-label" for="genderMale">
                                            Male
                                        </label>
                                    </div>                                
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <label for="emailAddress" class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" required <?php if(isset($emailAddress)){echo "value='$emailAddress'";} ?>>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Contact Information</legend>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="contactTypeId" class="col-sm-4 col-form-label">Contact Type</label>
                                        <div class="col-sm-8">
                                            <?php echo $bindContactList; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contactData" class="col-sm-4 col-form-label">Contact</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="contactData" name="contactData" placeholder="Contact Details" required <?php if(isset($contactData)){echo "value='$contactData'";} ?>>
                                        </div>
                                    </div>                             
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 pt-0">Address Information</legend>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="addressTypeId" class="col-sm-4 col-form-label">Address Type</label>
                                        <div class="col-sm-8">
                                            <?php echo $bindAddressList; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required <?php if(isset($address)){echo "value='$address'";} ?>>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-4 col-form-label">City</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required <?php if(isset($city)){echo "value='$city'";} ?>>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="stateLocated" class="col-sm-4 col-form-label">State</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="stateLocated" name="stateLocated" placeholder="State" required <?php if(isset($stateLocated)){echo "value='$stateLocated'";} ?>>
                                        </div>
                                    </div>                             
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Update my Profile" class="btn btn-primary">
                                <input type="hidden" name="action" value="update-owner"> 
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