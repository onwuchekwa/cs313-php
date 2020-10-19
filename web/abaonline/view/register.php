<?php 
    $pageTitle = 'Registration';
    $pageDescription = 'To add a business, you must have an account with us.';
    include $_SERVER['DOCUMENT_ROOT'] . '/abaonline/common/header.php'; 

    //$bindAddressList = buildAddressTypeList($addressList);
    $bindContactList = buildContactTypeList($contactList);

    $addressTypesList = '<select id="addressTypeId" name="addressTypeId" class="form-control" required>'; 
    $addressTypesList .= "<option value='' selected disabled>Choose Address Type</option>"; 
    foreach($addressList as $addressType) { 
        $addressTypesList .= "<option value='$addressType[address_type_id]'"; 
        if(isset($addressTypeId)){
            if($addressType['address_type_id'] === $addressTypeId){
                $addressTypesList .= ' selected ';
            }
        }
        $addressTypesList .= ">$addressType[description]</option>";
    } 
    $addressTypesList .= '</select>'; 
?>

<main>
    <div class="row">
        <div class="col-sm-12 col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    Register with Us
                </div>
                <div class="card-body">
                    <?php
                        if (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/abaonline/actions/index.php" method="POST">
                        <div class="form-group row">
                            <label for="userName" class="col-sm-4 col-form-label">User Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="User name" required <?php if(isset($userName)){echo "value='$userName'";} ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                            </div>
                        </div>
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
                                            <?php echo $addressTypesList; ?>
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