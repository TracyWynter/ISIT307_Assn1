<?php

//-- Product
# Basic Info
# Details
//-- Seller
# Personal Info
//Test
echo nl2br("ok\n");



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = $_GET["product_id"];

// Check and Read from GearDirectory.txt
    if (file_exists("GearDirectory.txt")) {
        $gearDir = file("GearDirectory.txt"); // Read file
        foreach ($gearDir as $line) {
            $lineArr = explode("::", $line); // Delimit the line
            if (strcasecmp($product_id, $lineArr[3]) == 0) {  // Zero if it is true
                echo "Product Found";

                // Placing image like this ain't it a bit hard coding?
                //Use Switch Case here
                //Picture
                //--Violin 1
                echo "<img src='Images/violin1.jpg' alt='Trulli' width='100' height='200'>";

                //--Violin 2
                echo "<img src='Images/violin2.jpg' alt='Trulli' width='100' height='200'>";

                //--Violin 3
                echo "<img src='Images/violin3.jpg' alt='Trulli' width='100' height='200'>";
            } else { //If status is sold out, picture will be shown and says sold out 
                //if()
                echo "Sold Out";
            }
        }
    } else {
        $gearDir = fopen("GearDirectory.txt", "x"); // Create mode
        fclose($gearDir);
        echo "Product Not Found";
    }
}




