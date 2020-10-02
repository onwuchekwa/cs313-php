<?php

// Get Root of the Document
function getDocumentRoot($document){
    $path = $_SERVER['DOCUMENT_ROOT'] . $document;
    return $path;
}

function loadProducts($filename) {
    $readFile = fopen($filename, "r") or die("Check if the file exist. The program is unable to read file");
    $products = fread($readFile, filesize($filename));
    fclose($readFile);
    $stockItems = json_decode($products);
    return $stockItems;
}

function loadOneProduct($stockItems, $itemId) {
    foreach($stockItems as $stockItem) {
        if($stockItem->itemId == $itemId) {
            $pd = "<h1 class='product-info-header'>$stockItem->itemName</h1>";
            $pd .= '<div class="product-info">';
            $pd .= '<div class="product-info-card">';
            $pd .= '<div class="text-container">';
            $pd .= "<h3>Price: $".number_format($stockItem->itemPrice, 2)."</h3>";
            $pd .= "<p class='product-stock'>";
            if ($stockItem->stockLeft < 10) {
                $pd .= "<span class='error'>Only $stockItem->stockLeft left. Order soon!</span></p>";
            } else {
                $pd .= "<span class='success'>$stockItem->stockLeft items in stock!</span></p>";
            }
            $pd .= "<p class='prod-discription'>$stockItem->productInfo<br/>";
            $pd .= '</div>';
            $pd .= "<img src='$stockItem->productImage' alt='An image showing $stockItem->productImage'>";
            $pd .= '</div>';
            $pd .= '</div>';
            return $pd;
        }
    }
}

function buildProductList($stockItems){
    $_SESSION["storeItems"] = $stockItems;
    $si = '<div class="product">';
    foreach($stockItems as $stockItem) {        
        $si .= '<div class="products-card">';
        $si .= "<a class='product-container' href='/web/week03/shopping/?action=product-detail&itemId=$stockItem->itemId' title='Click to view this product'>";
        $si .= "<img src='/web/week03/shopping/images/$stockItem->tnImage' alt='Image of $stockItem->itemName'>";
        $si .= '<hr class="separator">';
        $si .= "<h2>$stockItem->itemName</h2>";
        $si .= "<span>$".number_format($stockItem->itemPrice, 2)."</span>";
        $si .= '</a>';        
        $si .= '</div>';
    }
    $si .= '</div>';
    return $si;
}