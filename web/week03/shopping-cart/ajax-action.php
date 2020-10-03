<?php
    session_start();
    require_once("products.php");
    $prod = new Products();
    $prodList = $prod->populateAllProducts(); 

    if(!empty($_POST["action"])) {
        switch($_POST["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $itemCode = $productArray[$_POST["itemCode"]];
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
            break;
            case "empty":
                unset($_SESSION["cartItems"]);
            break;		
        }
    }