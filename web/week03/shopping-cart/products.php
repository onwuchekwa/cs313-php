<?php

class Products {
    public $productsArray = array(
        "Trouser01" => array(
            "itemId" => "1",
            "itemCode" => "1208",
            "itemName" => "Trouser",
            "itemPrice" => 35.25,
            "productImage" => "images/trouser.jpg"
        ), 
        "Shirt02" => array(
            "itemId" => "2",
            "itemCode" => "1209",
            "itemName" => "Shirt",
            "itemPrice" => 25.00,
            "productImage" => "images/shirt.jpg"
        ),
        "TShirt03" => array(
            "itemId" => "3",
            "itemCode" => "1210",
            "itemName" => "T-Shirt",
            "itemPrice" => 10.35,
            "productImage" => "images/tshirt.jpg"
        ),
        "Jean04" => array(
            "itemId" => "4",
            "itemCode" => "1211",
            "itemName" => "Jean",
            "itemPrice" => 25.99,
            "productImage" => "images/jean.jpg"
        ),
        "Skirt05" => array(
            "itemId" => "5",
            "itemCode" => "1212",
            "itemName" => "Skirt",
            "itemPrice" => 12.36,
            "productImage" => "images/skirt.jpg"
        ),
        "Blouse06" => array(
            "itemId" => "6",
            "itemCode" => "1213",
            "itemName" => "Blouse",
            "itemPrice" => 8.99,
            "productImage" => "images/blouse.jpg"
        )
    );

    public function populateAllProducts() {
        return $this->productsArray;
    }
}