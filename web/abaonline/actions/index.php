<?php

    // Action Controller

    // Create or access a Session
    session_start();
    // Get the database connection file
    require_once 'library/connections.php';
    // Get the acme model for use as needed
    require_once 'model/aba-online.php';
    // Get the functions.php file
    require_once 'library/functions.php';

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch ($action) {
        case 'registration':
            echo 'I am in registration';
            exit;
            include 'view/register.php';
        break;
        
        default:
            include 'view/login.php';
            exit;
        break;
    }