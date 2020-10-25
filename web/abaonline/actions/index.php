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
            include '../view/register.php';
            exit;
        break;

        case 'login':
            include '../view/login.php';
            exit;
        break;

        case 'logout':
            session_destroy();
            header('Location: /abaonline/');        
            setcookie('firstname', '', strtotime('-1 year'), '/');
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
            $contactTypeId = filter_input(INPUT_POST, 'contactTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $contactData = filter_input(INPUT_POST, 'contactData', FILTER_SANITIZE_STRING);
            $addressTypeId = filter_input(INPUT_POST, 'addressTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $stateLocated = filter_input(INPUT_POST, 'stateLocated', FILTER_SANITIZE_STRING);
            $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);

            // Call the validation functions
            $emailAddress = checkEmail($emailAddress);

            // Call the checkExistingEmail function
            $existingUserName = checkExistingUserName($userName);

            // Check for existing email address in the table
            if($existingUserName){                
                $message = '<p class="bg-danger">That username  already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($userName) || empty($firstName) || empty($lastName) || empty($password) || empty($gender) || empty($emailAddress) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                $message = '<p class="bg-danger">Please provide information for all empty form fields.</p>';
                include '../view/register.php';
                exit; 
            }

            // Check if password matches with confirm password
            if($password !== $confirmPassword) {
                $message = '<p class="bg-danger">Password is unmatched with confirm password filed</p>';
                include '../view/register.php';
                exit; 
            }


            // Hash the checked password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Send the data to the model
            $regOutcome = regBusinessOwner($userName, $hashedPassword, $firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated);

            // Check and report the result
            if($regOutcome === 1){
                setcookie('firstname', $firstName, strtotime('+1 year'), '/');
                $message = "<p class='bg-success'>Thanks for registering, $firstName. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p class='bg-danger'>Sorry $firstName, but the registration failed. Please try again.</p>";
                include '../view/register.php';
                exit;
            }
        break;

        case 'signin':
            // Filter and store the data
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Run basic checks, return if errors
            if(empty($userName) || empty($password)) {
                $message = '<p class="bg-danger">Please provide a valid username and password.</p>';
                include '../view/login.php';
                exit; 
            }

            // A valid password exists, proceed with the login process
            // Query the business owner's data based on the username
            $businessOwnerData = getBusinessOwner($userName);
           
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($password, $businessOwnerData['password']);
           
            // If the hashes don't match create an bg-danger
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="bg-danger">Please check your password and try again.</p>';
                include '../view/login.php';
                exit; 
            }


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
        break;

        case 'edit_user':
            $reference_id = filter_input(INPUT_GET, 'business_owner_id', FILTER_SANITIZE_NUMBER_INT);
            include '../view/business-owner-update.php';
            exit;
        break;

        case 'update-owner':
            // Filter and store the data
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $middleName = filter_input(INPUT_POST, 'middleName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
            $emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $contactTypeId = filter_input(INPUT_POST, 'contactTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $contactData = filter_input(INPUT_POST, 'contactData', FILTER_SANITIZE_STRING);
            $addressTypeId = filter_input(INPUT_POST, 'addressTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $stateLocated = filter_input(INPUT_POST, 'stateLocated', FILTER_SANITIZE_STRING);
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_NUMBER_INT);
            $businessOwnerId = filter_input(INPUT_POST, 'businessOwnerId', FILTER_SANITIZE_NUMBER_INT);
            $addressId = filter_input(INPUT_POST, 'addressId', FILTER_SANITIZE_NUMBER_INT);
            $contactId = filter_input(INPUT_POST, 'contactId', FILTER_SANITIZE_NUMBER_INT);

            echo $userName;
            exit;

            // Call the validation functions
            $emailAddress = checkEmail($emailAddress);

            // Check for missing data
            if(empty($firstName) || empty($lastName) || empty($gender) || empty($emailAddress) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                $message = '<p class="bg-danger">Please provide information for all empty form fields.</p>';
                include '../view/business-owner-update.php';
                exit; 
            }

            // Send the data to the model
            $updateInfoOutcome = updateBusinessOwnerInfo($firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated, $businessOwnerId, $addressId, $contactId);

            // Query the business owner data based on the user name
            $businessOwnerData = getBusinessOwner($userName); 

            // Check and report the result
            if($updateInfoOutcome === 1){
                $message = "<p class='bg-success'>Your data has been updated.</p>";
                $_SESSION['message'] = $message;
                // Remove the password from the array
                // the array_pop function removes the last
                // element from an array
                array_pop($businessOwnerData);            
                $_SESSION['businessOwnerData'] = $businessOwnerData;
                header('location: /abaonline/actions/'); 
                exit;

            } /*else {
                $message = "<p class='bg-danger'>Your data update failed. Please try again.</p>";
                header('location: /abaonline/actions/');
                exit;
            }*/
        break;

        case 'delete_user':
            $reference_id = filter_input(INPUT_GET, 'business_owner_id', FILTER_SANITIZE_NUMBER_INT);
            include '../view/business-owner-delete.php';
            exit;
        break;

        case 'delete-owner':
            $businessOwnerId = filter_input(INPUT_POST, 'businessOwnerId', FILTER_SANITIZE_NUMBER_INT);
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_NUMBER_INT);
            $addressId = filter_input(INPUT_POST, 'addressId', FILTER_SANITIZE_NUMBER_INT);
            $contactId = filter_input(INPUT_POST, 'contactId', FILTER_SANITIZE_NUMBER_INT);
                
            $deleteBusinessOwner = deleteBusinessOwner($businessOwnerId, $userName, $addressId, $contactId);
            if ($deleteBusinessOwner) {
                $message = "<p class='bg-success'>$userName was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /abaonline/');
                exit;
            } else {
                $message = "<p class='bg-danger'>Error: $userName was not deleted.</p>";
                $_SESSION['message'] = $message;
                include '../view/business-owner-delete.php';
                exit;
            }
        break;
        
        default:
            $businessOwnerId = $_SESSION['businessOwnerData']['business_owner_id'];
            include '../view/dashboard.php';
            exit;
        break;
    }