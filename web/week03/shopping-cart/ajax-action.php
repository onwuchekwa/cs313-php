<?php
    session_start();
    require_once("products.php");
    $prod = new Products();
    $prodList = $prod->populateAllProducts(); 

    if(!empty($_POST["action"])) {
        switch($_POST["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $itemCode = $prodList[$_POST["itemCode"]];
                    $itemArray = array(
                        $itemCode["itemCode"] => array(
                            'itemName'=> $itemCode["itemName"], 
                            'itemCode'=>$itemCode["itemCode"], 
                            'quantity'=>$_POST["quantity"], 
                            'itemPrice'=>$itemCode["itemPrice"]
                        )
                    );
                    
                    if(!empty($_SESSION["cartItems"])) {
                        $cartCodeArray = array_keys($_SESSION["cartItems"]);
                        if(in_array($itemCode["itemCode"], $cartCodeArray)) {
                            foreach($_SESSION["cartItems"] as $row => $item) {
                                if($itemCode["itemCode"] == $row) {
                                    $_SESSION["cartItems"][$row]["quantity"] = $_SESSION["cartItems"][$row]["quantity"] + $_POST["quantity"];
                                }
                            }
                        } else {
                            $_SESSION["cartItems"] = array_merge($_SESSION["cartItems"], $itemArray);
                        }
                    } else {
                        $_SESSION["cartItems"] = $itemArray;
                    }
                }
            break;
            case "remove":
                if(!empty($_SESSION["cartItems"])) {
                    foreach($_SESSION["cartItems"] as $row => $item) {
                        if($_POST["itemCode"] == $row)
                            unset($_SESSION["cartItems"][$row]);
                        if(empty($_SESSION["cartItems"]))
                            unset($_SESSION["cartItems"]);
                    }
                }
                //echo '<script type="text/javascript">location.reload(true);</script>';
                //exit;
            break;
            case "empty":
                unset($_SESSION["cartItems"]);
            break;	
            case "checkout":/*
                $clientName = filter_input(INPUT_POST, 'clientName', FILTER_SANITIZE_STRING);
                $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
                $clientPhone = filter_input(INPUT_POST, 'clientPhone', FILTER_SANITIZE_STRING);
                $clientAddress = filter_input(INPUT_POST, 'clientAddress', FILTER_SANITIZE_STRING);
                $clientPostal = filter_input(INPUT_POST, 'clientPostal', FILTER_SANITIZE_STRING);
                $clientState = filter_input(INPUT_POST, 'clientState', FILTER_SANITIZE_STRING);

                if(empty($clientName) || empty($clientEmail) || empty($clientPhone) || empty($clientAddress) || empty($clientPostal) || empty($clientState)) {
                    $message = '<p class="error">Please provide information for all empty form fields.</p>';
                    header('Location: checkout.php');
                    exit; 
                }

                $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
                $clientEmail = $valEmail;

                $clientDataArray = array(
                    'clientName' => $clientName,
                    'clientEmail' => $clientEmail,
                    'clientPhone' => $clientPhone,
                    'clientAddress' => $clientAddress,
                    'clientPostal' => $clientPostal,
                    'clientState' => $clientState
                );

                $_SESSION["clientData"] = $clientDataArray;*/
                //header('Location: confirmation.php');
                //exit;
                echo "<script type='text/javascript'>window.location='confirmation.php';</script>"; 
                exit;
            break;
        }
    }