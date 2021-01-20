<html>
    <head>
        <title><?php echo $_GET["product_id"]; ?></title>
        <style type="text/css">
            body{
                background:lightsteelblue;
                padding:20px 20px 50px 20px;
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
                width: 650px;
                margin-left:auto;
                margin-right:auto;
            }
            .fieldText{
                color:#4A646C;
                width:150px;
                display:inline-block;
                padding-right:40px;
                text-align:right;
                float:left;
            }
            .fieldText2{
                width: 250px;
                color:#4A646C;
                display:block;
                text-align:left;
            }
            .fieldText3{
                width: 350px;
                color:#4A646C;
                text-align:left;
            }
            .info{              
                text-align:left;

            }

            div.container .row1{
                padding: 10px;

            }
            div.container p{
                width: 350px;
                display: block;
                margin-left: auto;
                margin-right:auto;

            }

            .row1 div{
                display: inline-block;    
            }
            #rightCol{
                margin-left: 235px;
            }
            .sectionHead{
                text-align:center;
                background: lavender;
                color:black;
                border-radius: 4px;
                padding:4px;
            }
            #interest{
                text-align: center;
                color: teal;
            }
            #product_img{
                margin-top:35px;
                margin-left:auto;
                margin-right:auto;  
                display:block;
                width: 225px;
                height: 250px;
            }
            #product_desc{
                width: 500px;
                margin-left:auto;
                margin-right:auto;  
                display:block;
            }
            #desc{
                width: 300px;
                text-align:center;
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
            'conditions' => ''
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
                            'characteristics' =>implode(", ",  explode("~~",$lineArr[8])),
                            'conditions' => $lineArr[9]
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
                header("Location:myMusicGear.php?found=no");
            }
        }
        ?>
        <!-- HTML -->
        <!-- Page Heading Tag --> 
        <h1><center>My Music Gear </center></h1>
        <!-- Navigation -->
        <hr/>
        <ul>
            <li><a href="instrumentSales.php" class="navi">SELL INSTRUMENT</a></li>    <!-- Sales of instrument Page -->
            <li><a href="expInterest.php" class="navi">EXPRESS INTEREST</a></li>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
        </ul>
        <hr/>

        <!-- Product Information Section -->
        <div class="product">
            <div ><?php echo "<img id=\"product_img\" src='Images/" . $productArr['category'] . ".png'>"; ?></div>
            <div class="container">
                <h3 class="sectionHead">Basic Information</h3>
                <div class="row1">
                    <div><span class="fieldText3">Product id: </span><span class="info"><?php echo $productArr['product_id']; ?></span></div>
                    <div id="rightCol"><span class="fieldText3">Category: </span><span class="info"><?php echo $productArr['category']; ?></span></div>
                </div>
                <div class="row1"><span class="fieldText2">Description: </span></div>
                <div class="row1"><span class="info"><?php echo $productArr['description']; ?></span></div>
            </div>
            <br/>
            <div class="container">
                <h3 class="sectionHead">Details</h3>
                <p><span class="fieldText">Year of manufacture: </span><span class="info"><?php echo $productArr['manufacture_yr']; ?></span></p>
                <p><span class="fieldText">Brand: </span><span class="info"><?php echo $productArr['brand']; ?></span></p>
                <p><span class="fieldText">Characteristic(s): </span><span class="info"><?php echo $productArr['characteristics']; ?></span></p>
                <p><span class="fieldText">Condition: </span><span class="info"><?php echo $productArr['conditions']; ?></span></p>
            </div>
            <div id="interest"><span><?php echo "<b>$interestCount</b>"; ?></span> person(s) has express their interest</div>
            <br/>
            <!-- Seller Information -->
            <div class="container">
                <h3 class="sectionHead">Seller Information</h3>
                <p class="lineInfo"><span class="fieldText">Name: </span><span class="info"><?php echo $productArr['name']; ?></span></p>
                <p class="lineInfo"><span class="fieldText">Contact: </span><span class="info"><?php echo $productArr['phone']; ?></span></p>
                <p class="lineInfo"><span class="fieldText">Email: </span><span class="info"><?php echo $productArr['email']; ?></span></p>
            </div>
        </div>





    </body>
</html>






