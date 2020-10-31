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

        case 'add-business':
            include '../view/add-business.php';
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
                $message = '<p class="bg-danger p-3 text-white">That username  already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($userName) || empty($firstName) || empty($lastName) || empty($password) || empty($gender) || empty($emailAddress) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                $message = '<p class="bg-danger p-3 text-white">Please provide information for all empty form fields.</p>';
                include '../view/register.php';
                exit; 
            }

            // Check if password matches with confirm password
            if($password !== $confirmPassword) {
                $message = '<p class="bg-danger p-3 text-white">Password is unmatched with confirm password filed</p>';
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
                $message = "<p class='bg-success p-3 text-white'>Thanks for registering, $firstName. Please use your username and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p class='bg-danger p-3 text-white'>Sorry $firstName, but the registration failed. Please try again.</p>";
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
                $message = '<p class="bg-danger p-3 text-white">Please provide a valid username and password.</p>';
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
                $message = '<p class="bg-danger p-3 text-white">Please check your password and try again.</p>';
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
            // Send them to the Dashboard view
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
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $businessOwnerId = filter_input(INPUT_POST, 'businessOwnerId', FILTER_SANITIZE_NUMBER_INT);
            $addressId = filter_input(INPUT_POST, 'addressId', FILTER_SANITIZE_NUMBER_INT);
            $contactId = filter_input(INPUT_POST, 'contactId', FILTER_SANITIZE_NUMBER_INT);

            // Call the validation functions
            $emailAddress = checkEmail($emailAddress);

            // Check for missing data
            if(empty($firstName) || empty($lastName) || empty($gender) || empty($emailAddress) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                $message = '<p class="bg-danger p-3 text-white">Please provide information for all empty form fields.</p>';
                include '../view/business-owner-update.php';
                exit; 
            }

            // Send the data to the model
            $updateInfoOutcome = updateBusinessOwnerInfo($firstName, $middleName, $lastName, $gender, $emailAddress, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated, $businessOwnerId, $addressId, $contactId);

            // Query the business owner data based on the user name
            $businessOwnerData = getBusinessOwner($userName); 

            // Check and report the result
            if($updateInfoOutcome === 1){
                $message = "<p class='bg-success p-3 text-white'>Your data has been updated.</p>";
                $_SESSION['message'] = $message;
                // Remove the password from the array
                // the array_pop function removes the last
                // element from an array
                array_pop($businessOwnerData);            
                $_SESSION['businessOwnerData'] = $businessOwnerData;
                header('location: /abaonline/actions/'); 
                exit;

            } else {
                $message = "<p class='bg-danger p-3 text-white'>Your data update failed. Please try again.</p>";
                header('location: /abaonline/actions/');
                exit;
            }
        break;

        case 'delete_user':
            $reference_id = filter_input(INPUT_GET, 'business_owner_id', FILTER_SANITIZE_NUMBER_INT);
            include '../view/business-owner-delete.php';
            exit;
        break;

        case 'delete-owner':
            $businessOwnerId = filter_input(INPUT_POST, 'businessOwnerId', FILTER_SANITIZE_NUMBER_INT);
            $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $addressId = filter_input(INPUT_POST, 'addressId', FILTER_SANITIZE_NUMBER_INT);
            $contactId = filter_input(INPUT_POST, 'contactId', FILTER_SANITIZE_NUMBER_INT);
                
            $deleteBusinessOwner = deleteBusinessOwner($businessOwnerId, $userName, $addressId, $contactId);
            if ($deleteBusinessOwner) {
                $message = "<p class='bg-success p-3 text-white'>$userName was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                session_destroy();
                header('Location: /abaonline/');        
                setcookie('firstname', '', strtotime('-1 year'), '/');
                exit;
            } else {
                $message = "<p class='bg-danger p-3 text-white'>Error: $userName was not deleted.</p>";
                $_SESSION['message'] = $message;
                include '../view/business-owner-delete.php';
                exit;
            }
        break;

        case 'modify-password':
            // Holds the change password codes
        break;

        case 'add-new-business':
             // Filter and store the data
             $company_name = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
             $company_summary = filter_input(INPUT_POST, 'company_summary', FILTER_SANITIZE_STRING);
             $company_full_info = filter_input(INPUT_POST, 'company_full_info', FILTER_SANITIZE_STRING);
             $email_address = filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL);
             $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
             $reference_id = filter_input(INPUT_POST, 'reference_id', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
             $contactTypeId = filter_input(INPUT_POST, 'contactTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
             $contactData = filter_input(INPUT_POST, 'contactData', FILTER_SANITIZE_STRING);
             $addressTypeId = filter_input(INPUT_POST, 'addressTypeId', FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
             $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
             $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
             $stateLocated = filter_input(INPUT_POST, 'stateLocated', FILTER_SANITIZE_STRING);
 
             // Call the validation functions
             $email_address = checkEmail($email_address);
 
             // Check for missing data
             if(empty($company_name) || empty($company_full_info) || empty($company_summary) || empty($email_address) || empty($category_id) || empty($reference_id) || empty($contactTypeId) || empty($contactData) || empty($addressTypeId) || empty($address) || empty($city) || empty($stateLocated)) {
                 $message = '<p class="bg-danger p-3 text-white">Please provide information for all empty form fields.</p>';
                 include '../view/add-business.php';
                 exit; 
             }

              // Send the data to the model
            $regBusinessOutcome = regBusiness($company_name, $company_full_info, $company_summary, $email_address, $category_id, $reference_id, $contactTypeId, $contactData, $addressTypeId, $address, $city, $stateLocated);

            // Check and report the result
            if($regBusinessOutcome === 1){
                $message = "<p class='bg-success p-3 text-white'>Thanks for registering, $company_name.</p>";
                header("location: /abaonline/actions/");
                exit;
            } else {
                $message = "<p class='bg-danger p-3 text-white'>Sorry $company_name, but the registration failed. Please try again.</p>";
                include '../view/add-business.php';
                exit;
            }
        break;
        
        default:
            $businessOwnerId = $_SESSION['businessOwnerData']['business_owner_id'];
            $companyList = getCompanyInfoByOwner($businessOwnerId);
            var_dump($companyList);
            exit;
            if(count($companyList) > 0) {
                $displayCompanyInfoByOwner = buildCompanyList($companyList);
            }
            include '../view/dashboard.php';
            exit;
        break;
    }