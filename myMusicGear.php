<html>
    <head>
        <style type="text/css">
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

            /* Background*/
            body{
                background-image: url("Images/background.jpg");
                background-repeat: no-repeat;
                background-size: cover;
            }
            .error {
                color: red;
            }
            table td,tr{
                border: 1px solid black;
                padding: 8px;
            }
            table {
                border-spacing: 15px;
                border-color: transparent;
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
                header("Location: searchResult.php?product_id=" . $product_id);   // Redirect if validate correct
            } else {
                $product_idErr = "Product ID format should be in ccc-nnnn-yy format (E.g. abc-0123-14)";
            }
        }
        ?>
        <!-- Page Heading Tag --> 
        <h1><center> Welcome to My Music Gear </center></h1>
        <!-- Navigation -->
        <ul>
            <li><a href="#" class ="navi">HOME</a></li>
            <li><a href="#" class="navi">My ORDERS</a></li>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
        </ul>

        <!-- Search Submission -->
        <p><center>What are you looking for?</center></p>
<div>
    <form class="search" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
        <center>
            <input type="text" placeholder="Example:Guitar / Piano / Ukelele .... " name="search"> 
            <!--<button type="submit"><i class="fa fa-search">Search</i></button>-->
            <br/><br/><span class="error"><?php echo $product_idErr; ?></span>
        </center>
    </form>
</div>
<hr/>
<!-- Display Instrument Sales Product -->
<div>
    <center>
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
                $img = "<img src='Images/". $lineArr[4].".jpg' alt='img' width='80' height='150'>";
                $product = $img."<br/>Product ID: ".$lineArr[3]. "<br/>Category: ".$lineArr[4]. "<br/>Description: ".$lineArr[5];
                echo "<td align='left'>" . $product . "</td>";
                $instrumentCount--;
                $counter++;
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </center>
</div>


</body>
</html>
