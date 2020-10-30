<?php 
    $pageTitle = 'Registration';
    $pageDescription = 'To add a business, you must have an account with us.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    if (!$_SESSION['loggedin']) {
        header("location: /abaonline/actions/index.php?action=login");
    }

    $contactInfo = getContactInfo($reference_id);
    $addressInfo = getAddressInfo($reference_id);

    $addressList = getAddressType();
    $contactList = getContactType();
    
    $bindAddressList = buildAddressTypeList($addressList);
    $bindContactList = buildContactTypeList($contactList);

    $reference_id = $_SESSION['businessOwnerData']['business_owner_id'];
?>

<main class="container main-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/abaonline/" title="return to home page">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Business</li>
      </ol>
    </nav>
    <!-- /Breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Register your business with Us
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-4 col-form-label">Company Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Comapny Name" required <?php if(isset($company_name)){echo "value='$company_name'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_summary" class="col-sm-4 col-form-label">Company Summary</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_summary" name="company_summary" placeholder="Company Summary" required <?php if(isset($company_summary)){echo "value='$company_summary'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_full_info" class="col-sm-4 col-form-label">Company's Full Info</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="company_full_info" name="company_full_info" cols="30" rows="5" placeholder="Company's Full Background" <?php if(isset($company_full_info)){echo "value='$company_full_info'";} ?>>
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
                                <input type="submit" value="Register" class="btn btn-primary">
                                <input type="hidden" name="action" value="registered"> 
                            </div>
                        </div>     
                    </form>
                </div> 
                <div class="card-footer text-center">
                    <span class="d-block">Already a member?</span>
                    <a href="/abaonline/actions/index.php?action=login">Click here to login</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/footer.php'; ?>