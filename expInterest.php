<html>
    <head>
        <title>Product Interest</title>
        <!-- Styling -->
        <style type="text/css">
            .error {
                color: red;
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

        // Error variables
        $name = $phone = $email = $product_id = $pPrice = "";
        $nameErr = $phoneErr = $emailErr = $product_idErr = $pPriceErr = "";
        $checked = TRUE; // Only if TRUE then will write to txt file

        $phone_pattern = "/^\d{8}$/"; // Singapore phone number length
        $email_pattern = "^[\w-.]+@([\w-]+.)+[\w-]{2,4}$"; 
        $id_pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            # Name
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
                $checked = FALSE;
            } else {
                $name = clean_input($_POST["name"]);
            }
            # Contact Number
            if (empty($_POST["phone"])) {
                $phoneErr = "Phone is required";
                $checked = FALSE;
            } else if (!preg_match($phone_pattern, $_POST["phone"])) {
                $phoneErr = "8 Digits Required";
            } else {
                $phone = clean_input($_POST["phone"]);
            }
            # Email
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $checked = FALSE;
            } else {
                $email = clean_input($_POST["email"]);
            }
            # Product ID
            if (empty($_POST["productID"])) {
                $product_idErr = "Product ID  is required";
                $checked = FALSE;
            } else if (!preg_match($id_pattern, $_POST["productID"])) {
                $product_idErr = "Product ID format incorrect";
            } else {
                $product_id = clean_input($_POST["productID"]);
            }
            # Proposing Price
            if (empty($_POST["pPrice"])) {
                $pPriceErr = "Proposing price  is required";
                $checked = FALSE;
            } else {
                $pPrice = clean_input($_POST["pPrice"]);
            }

            // If all the mandatory information is entered
            if ($checked) {
                $interestFile = fopen("BuyerExInterests.txt", "a");  // Write at the end of the file (create if it does not exist)
                $data = $name . "::" . $phone . "::" . $email . "::" . $product_id . "::" . $pPrice . "\n";
                fwrite($interestFile, $data);
                fclose($interestFile);
            }

            // Display confirmation and success message
        }
        ?>
        <!-- HTML -->
        <h1>Expression of Interest</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            Name: <input type="text" name="name"><span class="error"> * <?php echo $nameErr; ?></span><br/><br/>
            Contact Number: <input type="text" name="phone"><span class="error"> * <?php echo $phoneErr; ?></span><br/><br>
            E-mail: <input type="text" name="email"><span class="error"> * <?php echo $emailErr; ?></span><br/><br/>
            Product id: <input type="text" name="productID"><span class="error"> * <?php echo $product_idErr ?></span><br/><br/>
            Proposing Price ($): <input type="text" name="pPrice"><span class="error"> * <?php echo $pPriceErr; ?></span><br/><br/>
            <input type="submit" name="submit" value="Submit"> 
        </form>


    </body>
</html>






