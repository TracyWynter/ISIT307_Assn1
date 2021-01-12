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
        $nameErr = $phoneErr = $emailErr = $product_idErr = $pPriceErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = clean_input($_POST["name"]);
            }

            if (empty($_POST["phone"])) {
                $phoneErr = "Phone is required";
            } else {
                $phone = clean_input($_POST["phone"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $emailErr = clean_input($_POST["email"]);
            }

            if (empty($_POST["product_id"])) {
                $product_idErr = "Product ID  is required";
            } else {
                $product_id = clean_input($_POST["product_id"]);
            }

            if (empty($_POST["pPrice"])) {
                $pPriceErr = "Proposing price  is required";
            } else {
                $pPrice = clean_input($_POST["pPrice"]);
            }
        }
        // Information to collect:
        # name
        # contact number
        # email
        # product id
        # proposing price
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






