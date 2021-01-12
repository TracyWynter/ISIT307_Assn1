<?php

//-- Product
# Basic Info
# Details

//-- Seller
# Personal Info

//Test
echo "ok";
//--Violin 1
echo "<img src='violin1.jpg' alt='Trulli' width='500' height='333'>";

//--Violin 2
echo "<img src='violin2.jpg' alt='Trulli' width='500' height='333'>";
//--Violin 3
echo "<img src='violin3.jpg' alt='Trulli' width='500' height='333'>";


// Test for regular expression
$product_id = filter_input(INPUT_GET, "search");
$pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy"
if (preg_match($pattern, $product_id)){
    echo "TRUE";
}
else{
    echo "False";
}
echo nl2br("\n" .$product_id) ;



