<html>
    <head>
        <title><?php echo $_GET["product_id"]; ?></title>
        <style type="text/css">
            body{
                background:thistle;
                padding:20px;
                font-family: Arial, Helvetica, sans-serif;
            }
            /* Page Navi Links */
            ul {
                list-style-type: none;
                margin: 0px 50px 0px 0px;
                overflow:hidden;
                padding:0;
            }
            li {
                float: right;
            }
            li a {
                display: block;
                padding: 8px;
                color: black;
                text-decoration: none;
            }
            li a:hover {
                color: grey;
            }
            hr {
                border: none;
                height: 2px;
                background: rgb(80,80,80);
                border-radius: 1px;
            }
            .product{
                text-align:left;
                margin-left: 300px;
            }

        </style>
    </head>
    <body>
        <?php
        $productArr = array(
            'name' => '',
            'phone' => '',
            'email' => '',
            'product_id' => '',
            'category' => '',
            'description' => '',
            'manufacture_yr' => '',
            'brand' => '',
            'characteristics' => '',
            'conditions' => '',
            'status' => ''
        );

        $interestCount = 0;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $found = FALSE;
            $product_id = strtolower($_GET["product_id"]);
            // Check and Read from GearDirectory.txt
            if (file_exists("GearDirectory.txt")) {
                $gearDir = file("GearDirectory.txt"); // Read file
                foreach ($gearDir as $line) {
                    $lineArr = explode("::", $line); // Delimit the line

                    if (strcasecmp($product_id, $lineArr[3]) == 0) {  // Zero if it is true
                        $found = TRUE;
                        $productArr = array(
                            'name' => $lineArr[0],
                            'phone' => $lineArr[1],
                            'email' => $lineArr[2],
                            'product_id' => $lineArr[3],
                            'category' => $lineArr[4],
                            'description' => $lineArr[5],
                            'manufacture_yr' => $lineArr[6],
                            'brand' => $lineArr[7],
                            'characteristics' => $lineArr[8],
                            'conditions' => $lineArr[9],
                            'status' => $lineArr[10]
                        );

                        if (file_exists("BuyerExInterests.txt")) {
                            $interestDir = file("BuyerExInterests.txt"); // Read file
                            foreach ($interestDir as $buyerLine) {
                                $buyerLineArr = explode("::", $buyerLine); // Delimit the 
                                if (strcmp($buyerLineArr[3], $productArr['product_id']) == 0) {   // if equal
                                    $interestCount++;
                                }
                            }
                        }
                        break;
                    } else { //If status is sold out, picture will be shown and says sold out 
                        //if()
                    }
                }
            } else {
                $gearDir = fopen("GearDirectory.txt", "x"); // Create mode
                fclose($gearDir);
                echo "Product Not Found";
            }

            if (!$found) {
                header("Location:searchFail.php?product_id=" . $product_id);
            }
        }
        ?>
        <!-- HTML -->
        <!-- Page Heading Tag --> 
        <h1><center>My Music Gear </center></h1>
        <!-- Navigation -->
        <hr/>
        <ul>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
            <li><a href="#" class="navi">My ORDERS</a></li>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
        </ul>
        <hr/>

        <!-- Product Information Section -->
        <div class="product">
            <div>
                <h3>Basic Information</h3>
                <p>Product id: <span><?php echo $productArr['product_id']; ?></span></p>
                <p>Category: <span><?php echo $productArr['category']; ?></span></p>
                <p>Description: <span><?php echo $productArr['description']; ?></span></p>
            </div>
            <br/>
            <div>
                <h3>Details</h3>
                <p>Year of manufacture: <span><?php echo $productArr['manufacture_yr']; ?></span></p>
                <p>Brand: <span><?php echo $productArr['brand']; ?></span></p>
                <p>Characteristic: <span><?php echo $productArr['characteristics']; ?></span></p>
                <p>Condition: <span><?php echo $productArr['conditions']; ?></span></p>
            </div>
            <div>
                <p>
                    <span>
                        <?php
                        if ($interestCount == 0) {
                            echo "No one ";
                        } else {
                            echo "<b>$interestCount</b>";
                        }
                        ?>
                    </span> 
                    person has express their interest.
                </p>
            </div>
            <br/>
            <!-- Seller Information -->
            <div>
                <h3>Seller Information</h3>
                <p>Name: <span><?php echo $productArr['name']; ?></span></p>
                <p>Contact: <span><?php echo $productArr['phone']; ?></span></p>
            </div>
        </div>





    </body>
</html>






