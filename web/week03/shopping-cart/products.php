<?php

class Products {
    public $productsArray = array(
        "Trouser01" => array(
            "itemId" => "1",
            "itemCode" => "Trouser01",
            "itemName" => "Trouser",
            "itemPrice" => 35.25,
            "productImage" => "images/trouser.jpg"
        ), 
        "Shirt02" => array(
            "itemId" => "2",
            "itemCode" => "Shirt02",
            "itemName" => "Shirt",
            "itemPrice" => 25.00,
            "productImage" => "images/shirt.jpg"
        ),
        "TShirt03" => array(
            "itemId" => "3",
            "itemCode" => "TShirt03",
            "itemName" => "T-Shirt",
            "itemPrice" => 10.35,
            "productImage" => "images/tshirt.jpg"
        ),
        "Jean04" => array(
            "itemId" => "4",
            "itemCode" => "Jean04",
            "itemName" => "Jean",
            "itemPrice" => 25.99,
            "productImage" => "images/jean.jpg"
        ),
        "Skirt05" => array(
            "itemId" => "5",
            "itemCode" => "Skirt05",
            "itemName" => "Skirt",
            "itemPrice" => 12.36,
            "productImage" => "images/skirt.jpg"
        ),
        "Blouse06" => array(
            "itemId" => "6",
            "itemCode" => "Blouse06",
            "itemName" => "Blouse",
            "itemPrice" => 8.99,
            "productImage" => "images/blouse.jpg"
        )
    );

    public function populateAllProducts() {
        return $this->productsArray;
    }
}