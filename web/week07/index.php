<?php 
    // index.php

    session_start();
    
    require_once 'model/connection.php';
    
    require_once 'model/account-model.php';

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action){
        case 'create_account':
            include 'view/register.php';
            exit;
        break;

        case 'account_login':
            include 'view/login.php';
            exit;
        break;

        case 'register':
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

            if(empty($username) || empty($password) || empty($confirm_password)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include 'view/create_account.php';
                exit; 
            }

            if($password !== $confirmPassword) {
                $message = '<p class="error">Password is unmatched with confirm password field</p>';
                include 'view/create_account.php';
                exit; 
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $regUserOutcome = regUserOutcome($username, $hashedPassword);

            if($regUserOutcome === 1){
                setcookie('username', $username, strtotime('+1 year'), '/');
                $message = "<p class='success'>Thanks for registering, $username. Please use your username and password to login.</p>";
                include 'view/login.php';
                exit;
            } else {
                $message = "<p class='error'>Sorry $username, but the registration failed. Please try again.</p>";
                include 'view/create_account.php';
                exit;
            }
        break;

        case 'login':
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if(empty($username) || empty($password)) {
                $message = '<p class="error">Please provide a valid username and password.</p>';
                include 'view/login.php';
                exit; 
            }
            
            $getUserOutcome = getUserOutcome($username);            
            $hashCheck = password_verify($password, $getUserOutcome['password']);
            
            if (!$hashCheck) {
                $message = '<p class="error">Please check your crendentials and try again.</p>';
                include 'view/login.php';
                exit; 
            }


            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Delete cookie at login
            setcookie('username', '', strtotime('-1 year'), '/');
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($getUserOutcome);
            // Store the array into the session
            $_SESSION['getUserOutcome'] = $getUserOutcome;            
            // Send them to the admin view
            header("location: /week07/");
            exit;
        break;

        case 'logout':
            session_destroy();
            header('Location: /week07/index.php?action=account_login');        
            setcookie('username', '', strtotime('-1 year'), '/');
            exit;
        break;
        
        default:
            include 'view/welcome.php';
            exit;
        break;
    }