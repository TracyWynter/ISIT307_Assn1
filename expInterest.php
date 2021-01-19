<html>
    <head>
        <title>Product Interest</title>

        <!-- Styling -->
        <style type="text/css">
            body{
                background:lightsteelblue;
                padding: 20px;
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
            /* Form Error Display */
            .error {
                color: red;
                width: 100px;   
            }
            .reminder{
                color:red;
                width: 350px;
                margin-left:30%;
                margin-right:auto;
            }
            .field {
                width:150px;
                display:inline-block;
                text-align:right;
                float:left;
                padding-right: 10px;
            }
            input.formText{
                text-align:left;
                border: 1px solid black;
                border-radius: 5px;
                padding: 4px;
                outline:none;
            }
            input.formText:focus{
                border:1px solid blue;
            }
            .interestForm{
                clear:both;
                width: 550px;
                margin-left:auto;
                margin-right:auto;
            }
            .formContainer{
                margin-right:auto;
            }
            .submitBtn{
                /*text-align:center;*/
                margin-left:253px;  /* custom made to align */
            }
            .submitBtn input[type=submit]{
                width: 80px;
                height:30px;
                cursor:pointer;
                border:2px solid grey;
                border-radius: 6px;
                background: grey;
                color: white;
                padding: 6px;                
            }
            .submitBtn input[type=submit]:hover{
                border: 2px solid green;
                background:green;
                color:white;
            }
            .submitBtn input[type=submit]:focus{
                outline:none;
                border: 2px solid green;
            }


            #msg{
                display:none;   /* set to none for default*/
                height:50px;
                width:500px;
                text-align:center;
                vertical-align:middle;
                background: lightgreen;
                color: white;
                margin-top:auto;
                margin-bottom:auto;
                margin-left:auto;
                margin-right:auto;
            }
        </style>
    </head>
    <body>
        <?php

        // String Cleaning
        function clean_input($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        // Used to store correct data
        $interestArr = array(
            'name' => '',
            'phone' => '',
            'email' => '',
            'product_id' => '',
            'pPrice' => ''
        );
        $nameErr = $phoneErr = $emailErr = $product_idErr = $pPriceErr = "";    // Error variables
        $msg = "";


        $phone_pattern = "/^[689]{1}[0-9]{7}$/"; // Singapore phone number length
        $email_pattern = '/^[a-zA-Z0-9]+(.[_a-z0-9-]+)(?!.*[\%\/\\\&\?\,\'\;\:\!\-]{2}).*@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$/';
        $id_pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14
        $checked = TRUE; // Only if TRUE then will write to txt file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST as $key => $value) {
                if (isset($interestArr[$key])) {
                    $interestArr[$key] = htmlspecialchars($value);
                }
            }
            # Name
            if (empty(clean_input($interestArr["name"]))) {
                $nameErr = "Name is required";
                $checked = FALSE;
            } else {
                $interestArr["name"] = clean_input($interestArr["name"]);
            }
            # Contact Number
            if (empty($interestArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "Phone is required";
            } else if (!preg_match($phone_pattern, $interestArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "Invalid phone format";
            } else {
                $interestArr["phone"] = clean_input($interestArr["phone"]);
            }
            # Email
            if (empty($interestArr["email"])) {
                $emailErr = "Email is required";
                $checked = FALSE;
            } else if (!preg_match($email_pattern, $interestArr["email"])) {
                $emailErr = "Invalid email format";
                $checked = FALSE;
            } else {
                $interestArr["email"] = clean_input($interestArr["email"]);
            }
            # Product ID
            if (empty($interestArr["product_id"])) {
                $product_idErr = "Product ID  is required";
                $checked = FALSE;
            } else if (!preg_match($id_pattern, $interestArr["product_id"])) {
                $product_idErr = "Product ID format incorrect";
                $checked = FALSE;
            } else {
                $interestArr["product_id"] = clean_input($interestArr["product_id"]);
            }
            # Proposing Price
            if (empty($interestArr["pPrice"])) {
                $pPriceErr = "Proposing price  is required";
                $checked = FALSE;
            } else if ($interestArr["pPrice"] <= 0) {
                $pPriceErr = "Please input a positive number";
                $checked = FALSE;
            } else {
                $interestArr["pPrice"] = clean_input($interestArr["pPrice"]);
            }
            // If all the mandatory information is entered
            if ($checked) {
                $interestFile = fopen("BuyerExInterests.txt", "a");  // Write at the end of the file (create if it does not exist)
                $data = $interestArr["name"] . "::" . $interestArr["phone"] . "::" . $interestArr["email"] . "::" . $interestArr["product_id"] . "::" . $interestArr["pPrice"] . "\n";
                fwrite($interestFile, $data);
                fclose($interestFile);
                echo '<script type = "text/javascript" >
                        alert("You have successfully submitted your interest web form");
                </script>';


                // Reset the array
                $interestArr = array(
                    'name' => '',
                    'phone' => '',
                    'email' => '',
                    'product_id' => '',
                    'pPrice' => ''
                );
                $checked = false;
            }
        }
        ?>
        <!-- Page Heading Tag --> 
        <h1><center>My Music Gear </center></h1>

        <!-- Navigation -->
        <hr/>
        <ul>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
            <li><a href="#" class="navi">My ORDERS</a></li>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
        </ul>

        <!-- HTML -->
        <hr/>
        <h2><center>Expression of Interest</center></h2>

        <div class="interestForm">
            <span class="reminder">[Please ensure all fields are filled]</span></br></br>  
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <div class="formContainer">
                    <label class="field" for="name">Name: </label><input type="text" name="name" id="name" class="formText" value="<?php echo $interestArr["name"]; ?>"><span class="error"> <?php echo $nameErr; ?></span><br/><br/>
                    <label class="field" for="phone">Contact Number: </label><input type="text" id="phone" class="formText" name="phone" value="<?php echo $interestArr["phone"]; ?>"><span class="error"> <?php echo $phoneErr; ?></span><br/><br/>
                    <label class="field" for="email"> E-mail: </label><input type="text"  placeholder="example@mail.com" id="email" name="email" class="formText" value="<?php echo $interestArr["email"]; ?>"><span class="error"> <?php echo $emailErr; ?></span><br/><br/>
                    <label class="field" for="product_id">Product id: </label><input type="text" id="product_id" class="formText" name="product_id" value="<?php echo $interestArr["product_id"]; ?>"><span class="error"> <?php echo $product_idErr ?></span><br/><br/>
                    <label class="field" for="pPrice">Proposing Price ($): </label><input type="text" id="pPrice" class="formText" name="pPrice" value="<?php echo $interestArr["pPrice"]; ?>"><span class="error"> <?php echo $pPriceErr; ?></span><br/><br/>
                    <div class="submitBtn">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>




    </body>
</html>






