<?php

// Create or access a Session
session_start();

// Get the functions.php file
require_once 'library/functions.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

$file = loadProducts('./data/stock.json');

switch ($action){
    case 'product-detail':
        $itemId = filter_input(INPUT_GET, 'itemId', FILTER_VALIDATE_INT); 
        $specificProduct = loadOneProduct($file, $itemId);    
        'view/product_details.php';
        break;
    
    default:
        //$file = loadProducts('./data/stock.json');
        $productDisplay = buildProductList($file);
        include 'view/browse_item.php';
   }