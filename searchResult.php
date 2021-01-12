<?php

//-- Product
# Basic Info
# Details
//-- Seller
# Personal Info
//Test
echo "ok";
//--Violin 1
echo "<img src='Images/violin1.jpg' alt='Trulli' width='500' height='333'>";

//--Violin 2
echo "<img src='Images/violin2.jpg' alt='Trulli' width='500' height='333'>";
//--Violin 3
echo "<img src='Images/violin3.jpg' alt='Trulli' width='500' height='333'>";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = $_GET["product_id"];

// Check and Read from GearDirectory.txt
    if (file_exists("GearDirectory.txt")) {
        $gearDir = file("GearDirectory.txt"); // Read file
        foreach ($gearDir as $line) {
            $lineArr = explode("::", $line); // Delimit the line
            if (strcasecmp($product_id, $lineArr[3]) == 0) {  // Zero if it is true
                echo "Product Found";
            } else {
                echo "Not Found";
            }
        }
    } else {
        $gearDir = fopen("GearDirectory.txt", "x"); // Create mode
        fclose($gearDir);
        echo "Product Not Found";
    }
}




