<html>
    <head>
        <style type="text/css">
            /* Background*/
            body{
                background-image: url("Images/background.jpg");
                background-repeat: no-repeat;
                background-size: cover;
                text-align:center;
                padding: 20px;
                font-family: Arial, Helvetica, sans-serif;
            }
            form.search input[type=text]{
                width: 60%;
                height: 30px;
                border-radius: 10px;
                border: transparent;
                padding: 6px;
            }
            /*remove search outline */
            form.search input[type=text]:focus{ 
                outline:none;
            }
            form.search button {
                height: 30px;
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

            .error {
                color: red;
            }
            .hrNavi {
                border: none;
                height: 2px;
                background: rgb(80,80,80);
                border-radius: 1px;
            }
            #productHr{
                border: none;
                height: 1px;
                background: rgb(80,80,80);
                border-radius: 1px;
            }

            /* Table for product display */
            table td,tr{
                overflow:hidden;
                text-overflow: ellipsis;
                border-radius: 4px;
                padding: 8px;
                background: snow;
                vertical-align: top;
                height: 300px;
                width: 250px;
            }
            table td:hover{
                cursor: pointer;
                background: coral;
            }

            table {
                border-spacing: 15px;
                border-color: transparent;
                margin-left: auto;
                margin-right:auto;
            }

            td a:link{
                text-decoration: none;
                color: dimgrey;
            }
            td a:visited{
                color:dimgrey;
            }
        </style>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);  //prevents form resubmission upon reload
            }
        </script>
        <title>My Music Gear</title>
    </head>

    <body>
        <?php
        // Product ID regular expression
        $product_idErr = " ";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST["search"];
            $pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14

            if (preg_match($pattern, $product_id)) {
                header("Location: searchResult.php?product_id=" . $product_id);   // Redirect if validate correct (GET)
            } else {
                $product_idErr = "Product ID format should be in ccc-nnnn-yy format (E.g. abc-0123-14)";
            }
        }
        ?>
        <!-- Page Heading Tag --> 
        <h1>Welcome to My Music Gear </h1>
        <!-- Navigation -->
        <hr class="hrNavi"/>
        <ul>
            <li><a href="#" class="navi">SIGN IN</a></li> 
            <li><a href="#" class="navi">REGISTER</a></li>
            <li><a href="instrumentSales.php" class="navi">SELL INSTRUMENT</a></li>    <!-- Sales of instrument Page -->
            <li><a href="#" class="navi">MY ORDERS</a></li>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
        </ul>
        <hr class="hrNavi"/>
        <br/>
        <!-- Search Submission -->
        <div>
            <form class="search" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <center>
                    <input type="text" placeholder="Enter Product id " name="search"> 
                    <!--<button type="submit"><i class="fa fa-search">Search</i></button>-->
                    <br/><br/><span class="error"><?php echo $product_idErr; ?></span>
                </center>
            </form>
        </div>

        <!-- Display Instrument Sales Product -->
        <div>

            <?php
            $readFile = file('GearDirectory.txt');
            $instrumentCount = count($readFile); // Total instrument in txt file
            $rows = (int) ($instrumentCount / 3) + 1; // amount of tr 
            $cols = 3; // amount of td (default is 3)

            $counter = 0;

            // Create a table
            echo "<table border='1'>";
            for ($tr = 1; $tr <= $rows; $tr++) {

                echo "<tr>";
                if ($instrumentCount < $cols) { // For the last row
                    $cols = $instrumentCount;
                }

                for ($td = 1; $td <= $cols; $td++) {
                    $lineArr = explode("::", $readFile[$counter]);
                    // Limit the description word characters 
                    if (strlen($lineArr[5]) > 65) {
                        $lineArr[5] = substr($lineArr[5], 0, 65) . " ...";
                    }
                    $img = "<img src='Images/" . $lineArr[4] . ".jpg'  width='80' height='150'>";
                    $product = $img . "<br/><hr id='productHr'/>Product ID: <a href='searchResult.php?product_id=" . $lineArr[3] . "'>" . $lineArr[3] . "</a><br/>Category: " . $lineArr[4] . "<br/>Description: " . $lineArr[5];
                    echo "<td align='left'>" . $product . "</td>";
                    $instrumentCount--;
                    $counter++;
                    echo "";
                }
            }

            echo "</tr>";

            echo "</table>";
            ?>

        </div>


    </body>
</html>
