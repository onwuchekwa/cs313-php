<?php

    // Actions Controller

    // Create or access a Session
    session_start();
    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/aba-online.php';
    // Get the functions.php file
    require_once '../library/functions.php';

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action) {
        case 'registration':
            // Get the array of contact and address types
			$bindAddressList = buildAddressTypeList(getAddressType());
            $bindContactList = buildContactTypeList(getContactType());
            include '../view/register.php';
            exit;
        break;

        case 'login':
            include '../view/login.php';
            exit;
        break;

        case 'registered':			
            // Filter and store the data
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $middleName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
            $emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $contactTypeId = filter_input(INPUT_POST, 'contactTypeId', FILTER_SANITIZE_NUMBER_INT);
            $contactData = filter_input(INPUT_POST, 'contactData', FILTER_SANITIZE_STRING);
            $addressTypeId = filter_input(INPUT_POST, 'addressTypeId', FILTER_SANITIZE_NUMBER_INT);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_EMAIL);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $stateLocated = filter_input(INPUT_POST, 'stateLocated', FILTER_SANITIZE_STRING);

            // Call the validation functions
            $emailAddress = checkEmail($emailAddress);

            // Call the checkExistingEmail function
            $existingUserName = checkExistingUserName($userName);

            // Check for existing email address in the table
            if($existingUserName){                
                $message = '<p class="error">That username  already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($userName) || empty($firstName) || empty($lastName) || empty($password) || empty($gender) || empty($emailAddress) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit; 
            }

            // Hash the checked password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Send the data to the model
            $regOutcome = regBusinessOwner($userName, $hashedPassword, $firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated);

            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $firstName, strtotime('+1 year'), '/');
                $message = "<p class='success'>Thanks for registering, $firstName. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p class='error'>Sorry $firstName, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
        break;

        case 'signin':
            // Filter and store the data
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Run basic checks, return if errors
            if(empty($userName) || empty($password)) {
                $message = '<p class="error">Please provide a valid username and password.</p>';
                include '../view/login.php';
                exit; 
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $businessOwnerData = getBusinessOwner($userName);
           
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($password, $businessOwnerData['password']);
            echo $hashCheck;
            exit;
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="error">Please check your password and try again.</p>';
                include '../view/login.php';
                exit; 
            }


 //           if ($password == $businessOwnerData['password']) {
                // A valid user exists, log them in
                $_SESSION['loggedin'] = TRUE;
                // Delete cookie at login
                setcookie('firstname', '', strtotime('-1 year'), '/');
                // Remove the password from the array
                // the array_pop function removes the last
                // element from an array
                array_pop($businessOwnerData);
                // Store the array into the session
                $_SESSION['businessOwnerData'] = $businessOwnerData;            
                // Send them to the admin view
                header("location: /abaonline/actions/");
                exit;
/*            } else {
                $message = '<p class="error">Please check your password and try again.</p>';
                include '../view/login.php';
                exit; 
            }*/
        break;
        
        default:
            $businessOwnerId = $_SESSION['businessOwnerData']['business_owner_id'];
            include '../view/dashboard.php';
            exit;
        break;
    }