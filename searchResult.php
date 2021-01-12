<?php

//-- Product
# Basic Info
# Details

//-- Seller
# Personal Info

//Test
echo "ok";
$product_id = filter_input(INPUT_GET, "search");
if (preg_match("/^$/", $product_id))
echo $product_id ;

?>

