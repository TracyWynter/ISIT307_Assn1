<html>
    <head>
        <style type="text/css">
            /* Background*/
            body{
                /*                background-image: url("Images/background.jpg");
                                background-repeat: no-repeat;
                                background-size: cover;*/
                background-color:lightsteelblue;    
                text-align:center;
                padding: 20px;
                font-family: Arial, Helvetica, sans-serif;
            }
            form.search #search{
                width: 60%;
                height: 30px;
                border-radius: 10px;
                border: transparent;
                padding: 6px;
            }
            /*remove search outline */
            form.search #search:focus{ 
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
            .product{
                margin:0;
                overflow:hidden;
                text-overflow: ellipsis;
                vertical-align: top;
                height: 100%;
                width: 100%;

            }
            table tr,td{
                padding:0;
                border:transparent;
                border-color:transparent;
                outline:none;
                background:transparent;
                height: 300px;
                width: 250px;

            }
            td button{
                border:none;
                border-radius: 4px;
                padding: 8px;
                background: snow;
                height: 300px;
                width: 250px;
                outline:none;
            }
            td button:hover{
                background: lavender;
                cursor:pointer;
            }
            table {
                border-spacing: 15px;
                border-color: transparent;
                margin-left: auto;
                margin-right:auto;
            }

            /* Product Details */
            .details{
                text-align:left;
                font-size:15px;
                font-family: Arial, Helvetica, sans-serif;
            }
            label{
                color:grey;
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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_GET["found"])){
                switch($_GET["found"]){
                    case "no":
                        $product_idErr = "The product that you are looking for does not exist";
                        break;
                    default:
                        $product_idErr = "The page that you are looking for does not exist";
                }
                
            }
            
        }
        
        
        ?>
        <!-- Page Heading Tag --> 
        <h1>Welcome to My Music Gear </h1>
        <!-- Navigation -->
        <hr class="hrNavi"/>
        <ul>
            <li><a href="instrumentSales.php" class="navi">SELL INSTRUMENT</a></li>    <!-- Sales of instrument Page -->
            <li><a href="expInterest.php" class="navi">EXPRESS INTEREST</a></li>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
        </ul>
        <hr class="hrNavi"/>
        <br/>
        <!-- Search Submission -->
        <div>
            <form class="search" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <center>
                    <input type="text" id="search" placeholder="Enter Product id " name="search"> 
                    <!--<button type="submit"><i class="fa fa-search">Search</i></button>-->
                    <br/><br/><span id="searchErr" class="error"><?php echo $product_idErr; ?></span>
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
            $counter = 0;   // Count for the number of records

            // Create a table in a form
            echo "<form  method='post' action='";
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
            echo "'>";
            echo "<table border='1'>";
            for ($tr = 1; $tr <= $rows; $tr++) {
                echo "<tr>";
                if ($instrumentCount < $cols) { // For the last row
                    $cols = $instrumentCount;
                }
                for ($td = 1; $td <= $cols; $td++) {
                    $lineArr = explode("::", $readFile[$counter]);
                    // Limit the description word characters at 65 chars
                    if (strlen($lineArr[5]) > 65) {
                        $lineArr[5] = substr($lineArr[5], 0, 65) . " ...";
                    }
                    $img = "<img src='Images/" . $lineArr[4] . ".png'  width='110' height='120'>";
                    $product = "<div  class='product'>" . $img . "<br/><hr id='productHr'/><div class='details'><label>Product ID:</label> " . $lineArr[3] . "<br/><label>Category: </label>" . $lineArr[4] . "<br/><label>Description: </label><br/>" . $lineArr[5] . "</div></div>";
                    echo "<td><button type='submit' name='search' value='" . $lineArr[3] . "'>" . $product . "</button></td>";
                    $instrumentCount--;
                    $counter++;
                    echo "";
                }
            }
            echo "</tr>";
            echo "</table>";
            echo "</form>";
            ?>
        </div>
    </body>
</html>