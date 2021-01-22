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
                width: 150px;   
                margin-left: 2px;

            }
            .reminder{
                display:block;
                color:red;
                width: 100%;
                text-align: center;
                float:left;
            }
            .field {
                width:180px;
                display:inline-block;
                text-align:right;
                float:left;
                padding-right: 30px;
            }
            input.formText{
                text-align:left;
                width: 200px;
                border: 1px solid black;
                border-radius: 5px;
                padding: 4px;
                outline:none;
            }
            input.formText:focus{
                border:1px solid teal;
            }
            .interestForm{
                width: 580px;
                margin-left:auto;
                margin-right:auto;
            }

            #header{
                text-align:center;
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
        // String Cleaning
        function clean_input($input) {
            $input = trim($input);  // Remove leading and trailing whitespace 
            $input = stripslashes($input);  // Remove '\' (slashes)
            $input = str_replace("~", "-", $input); // Prevent it from messing up data storage (Delimiter: "~~")
            $input = str_replace(":", "-", $input); // Prevent it from messing up data storage (Delimiter: "::")
            $input = htmlspecialchars($input);  // Treat special chars as HTML entities
            $input = strtolower($input);    // All chars to lowercase
            return $input;
        }

        // String standardise of band and other names (e.g. Yamaha)
        function capsFirst($input) {
            $input = clean_input($input);
            $input = ucfirst($input);   // First char is uppercase
            return $input;
        }

        // Human name standardise (e.g. Bob Josh)
        function nameStandard($input) {
            $input = clean_Input($input);
            $input = ucwords(strtolower($input));
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

        $name_pattern = "/^(?![ .]+$)[a-zA-Z ,]*$/";
        $phone_pattern = "/^[689]{1}[0-9]{7}$/"; // Singapore phone number length
        $email_pattern = '/^[a-zA-Z0-9]+(.[_a-z0-9-]+)(?!.*[~@\%\/\\\&\?\,\'\;\:\!\-]{2}).*@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$/';
        $id_pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14
        $checked = TRUE; // Only if TRUE then will write to txt file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST as $key => $value) {
                if (isset($interestArr[$key])) {
                    $interestArr[$key] = htmlspecialchars($value);
                }
            }
            // Do validations
            # Name
            if (empty(clean_input($interestArr["name"]))) {
                $nameErr = "Required";
                $checked = FALSE;
            } else if (!preg_match($name_pattern, $interestArr["name"])) {   // Validation for Name
                $nameErr = "Invalid Name";
                $checked = FALSE;
            } else {
                $interestArr["name"] = nameStandard($interestArr["name"]);
            }
            # Contact Number
            if (empty($interestArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "Required";
            } else if (!preg_match($phone_pattern, $interestArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "Invalid Format";
            } else {
                $interestArr["phone"] = clean_input($interestArr["phone"]);
            }
            # Email
            if (empty($interestArr["email"])) {
                $emailErr = "Required";
                $checked = FALSE;
            } else if (!preg_match($email_pattern, $interestArr["email"])) {
                $emailErr = "Invalid Format";
                $checked = FALSE;
            } else {
                $interestArr["email"] = clean_input($interestArr["email"]);
            }
            # Product ID
            if (empty($interestArr["product_id"])) {    // Empty
                $product_idErr = "Required";
                $checked = FALSE;
            } else if (!preg_match($id_pattern, $interestArr["product_id"])) {  // Incorrect Format
                $product_idErr = "Invalid Format";
                $checked = FALSE;
            } else if (!file_exists("GearDirectory.txt")) {   // Instrument File does not exist
                $product_idErr = "Not Found";
                $checked = FALSE;
            } else {
                // Check if the product exist in the "GearDirectory.txt"
                $instrumentFile = file("GearDirectory.txt");
                foreach ($instrumentFile as $fileLine) {
                    $fileLineArr = explode("::", $fileLine);
                    if ($fileLineArr[3] !== $interestArr["product_id"]) { // If the product does not exist
                        $product_idErr = "Not Found";
                        $checked = FALSE;
                    } else {
                        $product_idErr = "";
                        $checked = TRUE;
                        break;  // If it is found no further checks needed
                    }
                }
            }
            # Proposing Price
            if (empty($interestArr["pPrice"])) {
                $pPriceErr = "Required";
                $checked = FALSE;
            } else if (!is_numeric($interestArr["pPrice"])) {
                $pPriceErr = "Invalid Number";
                $checked = FALSE;
            } else if ($interestArr["pPrice"] <= 0) {
                $pPriceErr = "Only Positive Number";
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
            <li><a href="instrumentSales.php" class="navi">SELL INSTRUMENT</a></li>    <!-- Sales of instrument Page -->
            <li><a href="expInterest.php" class="navi">EXPRESS INTEREST</a></li>    <!-- Product Interest Expression -->
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>   <!-- Main Page -->
        </ul>

        <!-- HTML -->
        <hr/>
        <div id="header">
            <h2>Expression of Interest</h2>
        </div>
        <div class="interestForm">
            <span class="reminder">[Please ensure all fields are filled]</span></br></br>  
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <div class="formContainer">
                    <label class="field" for="name">Name: </label><input type="text" name="name" id="name" class="formText" value="<?php echo $interestArr["name"]; ?>"><span class="error"> <?php echo $nameErr; ?></span><br/><br/>
                    <label class="field" for="phone">Contact Number: </label><input type="text" id="phone" class="formText" placeholder = "8 digit number" name="phone" value="<?php echo $interestArr["phone"]; ?>"><span class="error"> <?php echo $phoneErr; ?></span><br/><br/>
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






