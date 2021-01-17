<html>
    <head>
        <title>Sales of Instrument</title>
        <style type="text/css">
            body{
                padding: 20px;
                text-align:center;
                background: beige;
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
            .instrumentForm{
                width:800px;
                margin-left:auto;
                margin-right:auto;


            }
            .sectionHead{
                text-align:center;

            }
            .sectionDetails p{
                text-align:center;
                float:right;

            }
            input{
                float:center;
            }

        </style>

    </head>
    <body onload="loadYear()">
        <?php
        // Used to store correct data
        $salesArr = array(
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            /* Load value into array */
            foreach ($_POST as $key => $value) {
                if (isset($salesArr[$key])) {
                    $salesArr[$key] = htmlspecialchars($value);
                }
            }
            /* After loading information */





            /* Seller Information */
            # Name
            if (empty(clean_input($salesArr["name"]))) {
                $nameErr = "Name is required";
                $checked = FALSE;
            } else {
                $salesArr["name"] = clean_input($salesArr["name"]);
            }
            # Contact Number
            if (empty($salesArr["phone"])) {
                $phoneErr = "Phone is required";
                $checked = FALSE;
            } else if (!preg_match($phone_pattern, $salesArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "8 Digits Required";
            } else {
                $salesArr["phone"] = clean_input($salesArr["phone"]);
            }
            # Email
            if (empty($salesArr["email"])) {
                $emailErr = "Email is required";
                $checked = FALSE;
            } else if (!preg_match($email_pattern, $salesArr["email"])) {
                $checked = FALSE;
                $emailErr = "Invalid email format";
            } else {
                $salesArr["email"] = clean_input($salesArr["email"]);
            }
        }
        ?>


        <!--Page Heading Tag-->
        <h1><center>My Music Gear </center></h1>
        <!-- Navigation -->
        <hr/>
        <ul>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
            <li><a href="#" class="navi">MY ORDERS</a></li>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
        </ul>
        <hr/>

        <h2>Sales of Instrument</h2>
        <!-- Instrument Details -->
        <form class="instrumentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <div class="sectionDetails" >
                <h4 class="sectionHead">Instrument Basic Information</h4><br/>
                Product ID:<input type="text"><br/><br/>
                Category: <input type="text" placeholder="E.g. Guitar/Violin .."><br/><br/>
                Description:<textarea width="200px;"></textarea><br/><br/>
            </div>
            <div>
                <h4>Instrument Details</h4><br/>
                <p>Year of manufacture:
                    <select>
                        <option value>

                    </select>
                </p>
            </div><br/>


            <!-- Seller Information -->

            <div class="sectionDetails">
                <h4 class="sectionHead" align='center'>Seller Information</h4>
                Name: <input type="text" pattern="^[A-Za-z]*$"></br></br>
                Phone: <input type="text" pattern="^[1-9][0-9]{9,14}$"><br/><br/>
                Email: <input type="text" placeholder="example@abc.com" pattern="^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$"><br/><br/>
            </div>
        </form>
    </body>
</html>
