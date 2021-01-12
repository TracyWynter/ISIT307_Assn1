<html>
    <head>
        <title>My Music Gear</title>
        <style type="text/css">
            form.search input[type=text]{
                width: 60%;
                height: 30px;
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
        </style>
    </head>

    <body>
        <?php
        // Product ID regular expression
        $product_idErr = " ";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST["search"];
            $pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14

            if (preg_match($pattern, $product_id)) {
                header("Location: searchResult.php?product_id=".$product_id);   // Redirect if validate correct
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
        <form class="search" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            <center>
                <input type="text" placeholder="Example:Guitar / Piano / Ukelele .... " name="search"> 
                <button type="submit"><i class="fa fa-search">Search</i></button><br/><br/>
                <span class="error"><?php echo $product_idErr; ?></span>
            </center>
        </form>

</body>
</html>
