<html>
    <head>
        <title>Product Interest</title>
        <!-- Styling -->
        <style type="text/css">
            body{
                background:beige;
            }
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
            .interestForm{
                width: 500px;
                border:1px solid black; /* test */
                margin-left:auto;
                margin-right:auto;
            }
            input {
                text-align:right;
                float:right;

            }
            .formContent {
                text-align:right;
                float:right;
            }
            .msg{
                visibility: hidden;
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
        $checked = TRUE; // Only if TRUE then will write to txt file

        $phone_pattern = "/^\d{8}$/"; // Singapore phone number length
        $email_pattern = '/^[a-zA-Z0-9]+(.[_a-z0-9-]+)(?!.*[\%\/\\\&\?\,\'\;\:\!\-]{2}).*@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$/';
        $id_pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($_POST as $key => $value) {
                if (isset($interestArr[$key])) {
                    $interestArr[$key] = htmlspecialchars($value);
                }
            }
            # Name
            if (empty($interestArr["name"])) {
                $nameErr = "Name is required";
                $checked = FALSE;
            } else {
                $interestArr["name"] = clean_input($interestArr["name"]);
            }
            # Contact Number
            if (empty($interestArr["phone"])) {
                $phoneErr = "Phone is required";
                $checked = FALSE;
            } else if (!preg_match($phone_pattern, $interestArr["phone"])) {
                $checked = FALSE;
                $phoneErr = "8 Digits Required";
            } else {
                $interestArr["phone"] = clean_input($interestArr["phone"]);
            }
            # Email
            if (empty($interestArr["email"])) {
                $emailErr = "Email is required";
                $checked = FALSE;
            } else if (!preg_match($email_pattern, $interestArr["email"])) {
                $checked = FALSE;
                $emailErr = "Invalid email format";
            } else {
                $interestArr["email"] = clean_input($interestArr["email"]);
            }
            # Product ID
            if (empty($interestArr["product_id"])) {
                $product_idErr = "Product ID  is required";
                $checked = FALSE;
            } else if (!preg_match($id_pattern, $interestArr["product_id"])) {
                $product_idErr = "Product ID format incorrect";
            } else {
                $interestArr["product_id"] = clean_input($interestArr["product_id"]);
            }
            # Proposing Price
            if (empty($interestArr["pPrice"])) {
                $pPriceErr = "Proposing price  is required";
                $checked = FALSE;
            } else if ($interestArr["pPrice"] <= 0) {
                $pPriceErr = "Please input a positive number";
            } else {
                $interestArr["pPrice"] = clean_input($interestArr["pPrice"]);
            }

            // If all the mandatory information is entered
            if ($checked) {
                $interestFile = fopen("BuyerExInterests.txt", "a");  // Write at the end of the file (create if it does not exist)
                $data = $interestArr["name"] . "::" . $interestArr["phone"] . "::" . $interestArr["email"] . "::" . $interestArr["product_id"] . "::" . $interestArr["pPrice"] . "\n";
                fwrite($interestFile, $data);
                fclose($interestFile);
                $msg = "Your expression of interest has been submitted successfully";
                // Reset the array
                $interestArr = array(
                    'name' => '',
                    'phone' => '',
                    'email' => '',
                    'product_id' => '',
                    'pPrice' => ''
                );
            }

            // Display confirmation and success message
        }
        ?>
        <!-- HTML -->
        <h1><center>Expression of Interest</center></h1>

        <div class="interestForm">

            <span class="reminder">[Please ensure all fields are filled]</span></br></br>  
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                Name: </span><input type="text" name="name" value="<?php echo $interestArr["name"]; ?>"><span class="error"> <?php echo $nameErr; ?></span><br/><br/>
                Contact Number: <input type="text" name="phone" value="<?php echo $interestArr["phone"]; ?>"><span class="error"> <?php echo $phoneErr; ?></span><br/><br>
                E-mail: <input type="text" name="email" value="<?php echo $interestArr["email"]; ?>"><span class="error"> <?php echo $emailErr; ?></span><br/><br/>
                Product id: <input type="text" name="product_id" value="<?php echo $interestArr["product_id"]; ?>"><span class="error"><?php echo $product_idErr ?></span><br/><br/>
                Proposing Price ($): <input type="text" name="pPrice" value="<?php echo $interestArr["pPrice"]; ?>"><span class="error"> <?php echo $pPriceErr; ?></span><br/><br/>
                <input type="submit" name="submit" value="Submit">
            </form>

        </div>
        <div class="msg"><?php echo $msg; ?></div>


    </body>
</html>






