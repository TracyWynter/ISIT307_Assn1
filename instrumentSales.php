<html>
    <head>
        <title>Sales of Instrument</title>
        <!-- Add icon library from external web -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
            body{
                padding: 20px;
                text-align:center;
                background: lightsteelblue;
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



            /* Form Submit Button */
            .submitBtn{
                margin-left:auto;
                margin-right:auto;
            }
            .submitBtn input[type=submit]{
                width: 80px;
                height:30px;
                margin-top:22px;
                margin-bottom:6px;
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
            /* Condition Radio Button */
            .hideRadio
            {
                /*hide the radio button*/
                display:none;
            }
            /*The button label for gender*/
            .conBtnLabel
            {
                width:50px;
                display:inline-block;
                cursor:pointer;
                border-radius: 5px;
                margin-right: 5px;
                margin-left:2px;
                background: lightgrey;
                color:black;
                padding: 1px 5px;
                float:left;

            }
            /*When male radio btn is checked*/
            #new:checked + .conBtnLabel
            {
                background: lightgreen;
                color:black;
            }
            /*When female radio btn is checked*/
            #used:checked + .conBtnLabel
            {
                background: lightgreen;
                color:black;
            }
            /* Form */
            .instrumentForm{
                width:700px;
                margin-left:auto;
                margin-right:auto;
            }
            .sectionHead{
                text-align:center;
                background: lavender;
                color:black;
                border-radius: 4px;
                padding:4px;

            }
            .sectionDetails{
                display:inline-block;
                width: 650px;
                margin-left:auto;
                margin-right:auto;

                border: 1px solid black;

            }
            .normalSection{              
                margin-top:2px;
                margin-bottom:2px;
                padding:5px;
                height:25px;
                border:1px solid black;
            }
            .instrumentLabel{
                width: 200px;
                height: 25px;
                display:inline-block;
                padding-right:15px;
                text-align:right;
                float:left;
                border:1px solid black;

            }
            input.formText{
                text-align:left;
                height: 23px;
                float:left;
                margin-left:2px;
                border:1.5px solid grey;
                border-radius:5px;
                padding: 2px 4px 2px 4px;
                outline:none;
            }
            input.formText:focus{
                outline:none;
                border:1.5px solid teal;
            }
            /* Special Description Section */
            .descSection{
                margin-top:2px;
                margin-bottom:2px;
                padding:5px;
                height: 220px;

            }
            #desc{
                resize:none;
                margin-top:10px;
                width: 640px;
                height:150px;
                border-radius:5px;
                padding: 2px 4px 2px 4px;
                float:left;
            }

            #desc:focus{
                outline:none;
            }
            /* Manufacture Year */
            .selectOpt {
                margin-left: 2px;
                display:block;
                outline:none;
                border:1.5px solid grey;
                border-radius: 4px;
                padding: 2px 3px 2px 3px;
                float:left;

            }

            .selectOpt:focus{
                outline:none;
                border: 1.5px solid teal;
            }

            #manufacture_yr{
                width: 100px;

            }
            #category{
                width: 150px;
            }

            /* Form Error Display */
            .error {
                color: red;
                width: 225px;   
                text-align:left;
                float:right;
            }
            #descErr{
                margin-top:5px;
                text-align:center;
                width:100%;
                display:block;
            }
            #charErr{
                width: 180px;
                text-align:left;
                float:right;
            }
            /* Characteristics */
            #addChar{
                border: none;
                border-radius:8px;
                margin-left: 2px;
                padding: 6px 8px 6px 8px;
                float:left;
                cursor:pointer;
                color: white;
                background: cadetblue;
            }
            #addChar:focus{
                outline:none;              
            }
            #addChar:hover{
                background: lightseagreen;
            }
            #addChar:disabled{
                cursor: not-allowed;
            }
            /* Display Section for characteristics textbox*/
            .charSection{
                padding:10px;
                border: 1px solid black;              
            }
            #charDisplay{

                width: 10px;
                margin: 100px;

            }
            .chars{
                display: inline-block;
                float: left;
                width: 50px;
                height: 30px;
            }
            .theChars{
                border-radius: 4px;
                padding: 4px;
                margin-right: 2px;
                background:royalblue;
                color:whitesmoke;    

            }
            .trash{
                margin-left:8px;
                cursor:pointer;             
            }
            .trash:hover{
                color:red;
            }



        </style>
        <script>
            /* onLoad (functions to be called onload) */
            function loadAll() {
                charLoad();
            }

            var charCount = 0;
            var charArr = [];

            /* Load Characteristic Array */
            function charLoad() {
                if (charArr.length > 0) {
                    for (var j = 0; j < charArr.length; j++) {
                        createChar(charArr[j]);
                    }
                }
            }
            /* Create one char */
            function createChar(input) {
                var hiddenVal = "<input type='hidden' name='characteristics[" + input + "]' value=" + input + ">"; // Store value
                var display = document.getElementById("charDisplay"); // Holds all characteristics
                // display(newChar(trash), newChar(trash))

                // Trash Child Element
                var trash = document.createElement("span");
                trash.setAttribute("class", "fa fa-trash trash");
                trash.onclick = removeCharacteristic;
                trash.innerHTML += hiddenVal; // Cannot be attached to newChar (error)

                //Parent 
                var newChar = document.createElement("span"); // parent element stores each char
                newChar.setAttribute("class", "theChars");
                newChar.setAttribute("id", input);
                newChar.textContent = input; // The char text display

                // Add Child Element
                newChar.appendChild(trash);
                if (charCount < 5) {
                    display.appendChild(newChar);
                    charCount++;
                }
                charChange(); // Add button (enabled / disable)
            }
            /* Remove whitespace (e.g. "wHite" to  "White")*/
            function charCleaning(char) {
                char = char.trim();
                char = char.charAt(0).toUpperCase() + char.slice(1).toLowerCase();
                return char;
            }

            /* Add One More Characteristic (Add Button) */
            function addCharacteristic() {
                var input = document.getElementById("characteristicInput");
                var err = document.getElementById("charErr");

                var cleanInput = charCleaning(input.value);
                var exist = false;
                //Input not empty
                if (cleanInput.length > 0) {

                    // Does not exist in the characteristics array
                    if (charArr.length > 0) {
                        for (var i = 0; i < charArr.length; i++) {
                            if (cleanInput === charArr[i]) {

                                exist = true;
                                break;
                            }
                        }
                    }
                    // Only execute if the characteristic does not exist
                    if (exist === false) {
                        charArr.push(cleanInput);
                        createChar(cleanInput);
                        // display(newChar(trash), newChar(trash))
                        input.value = "";    // Clear the textbox 
                    } else {
                        err.innerHTML = "Already exist";
                    }
                } else {
                    err.innerHTML = "Cannot be empty";
                }
            }

            /* This is a onclick function that is attached to each characteristics */
            function removeCharacteristic() {
                var charId = this.parentNode.id;
                var char = this.parentNode; // The Element that contains text and delete (newChar)
                char.parentNode.removeChild(char); // char's parent node to remove char

                // Remove the key from the array which key refers to characteristics[key]
                for (var i = 0; i < charArr.length; i++) {
                    document.getElementById("charErr").innerHTML = charId;
                    if (charId === charArr[i]) {
                        var index = charArr.indexOf(charId);

                        if (index > -1) {   // Just to make sure it does not go array index out of bound
                            charArr.splice(index, 1);
                        }
                        break;
                    }
                }
                charCount--;
                charChange();
            }
            // Add button status change
            function charChange() {
                /* Button Only Active if Less than 5 char */
                if (charCount < 5) {
                    document.getElementById("addChar").disabled = false;
                } else {
                    document.getElementById("addChar").disabled = true;
                }
            }

        </script>

    </head>
    <body onload="loadAll()">

        <?php

        // String Cleaning
        function clean_input($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function brandStandard($input) {
            $input = clean_input($input);
            $input = strtolower($input);    // All chars to lowercase
            $input = ucfirst($input);   // First char is uppercase
            return $input;
        }

        // Load the years to select option element
        function loadYear($selected) {
            $string = '';
            $years = array_combine(range(date("Y"), 1910), range(date("Y"), 1910));

            $string = '<option hidden selected value=" ">Select Year</option>';
            foreach ($years as $key => $value) {
                $optionContent = ($selected == $key) ? 'selected="selected"' : '';
                $string .= '<option value="' . $key . '"' . $optionContent . '>' . $value . '</option>' . "\n";
            }
            echo $string;
        }

        $name_pattern = "/^[A-Za-z]*$/";
        $phone_pattern = "/^[689]{1}[0-9]{7}$/"; // Singapore phone number length
        $email_pattern = '/^[a-zA-Z0-9]+(.[_a-z0-9-]+)(?!.*[\%\/\\\&\?\,\'\;\:\!\-]{2}).*@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$/';
//        $email_pattern2 = '^(?=.{1,64}@)[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)@[^-][A-Za-z0-9-]+(\.[A-Za-z0-9-]+)(\.[A-Za-z]{2,})$';
        $id_pattern = "/^[a-z|A-Z]{3}-[0-9]{4}-[0-9]{2}$/"; // Do not REMOVE "ccc-nnnn-yy" e.g. abc-0123-14
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
            'characteristics' => array(),
            'conditions' => '',
            'status' => ''
        );
        $nameErr = $phoneErr = $emailErr = $product_idErr = $pPriceErr = $categoryErr = $yrErr = $descErr = $brandErr = $conditionErr = $characteristicsErr = "";    // Error variables
        $checked = TRUE; // Only if TRUE then will write to txt file
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            /* Load value into array */
            foreach ($_POST as $key => $value) {
                //                echo $key.":".$value."<br/>";   //test
                if ($key == 'characteristics') {
                    foreach ($_POST[$key] as $key2 => $data) {
                        echo $key2 . " space " . $data . "<br/>";   //testing
                        $salesArr[$key][$key2] = htmlspecialchars($data);
                    }
                } else if (isset($salesArr[$key])) {
                    $salesArr[$key] = htmlspecialchars($value);
                }
            }
            /* After loading information */

            /* Product Information */
            # Product ID
            if (empty($salesArr["product_id"])) {
                $product_idErr = "Product ID  is empty";
                $checked = FALSE;
            } else if (!preg_match($id_pattern, $salesArr["product_id"])) {
                $product_idErr = "Product ID format incorrect";
                $checked = FALSE;
            } else {               
                $salesArr["product_id"] = clean_input($salesArr["product_id"]);
            }

            # Category
            if (empty(clean_input($salesArr["category"]))) {
                $categoryErr = "Category not selected";
                $checked = FALSE;
            } else {
                $salesArr["category"] = clean_input($salesArr["category"]);
            }

            # Description
            if (empty(clean_input($salesArr["description"]))) {
                $checked = FALSE;
                $descErr = "Description is empty";
            } else {
                $salesArr["description"] = clean_input($salesArr["description"]);
            }

            # Manufacture Year
            if (empty(clean_input($salesArr["manufacture_yr"]))) {
                $yrErr = "Manufacture year not selected";
                $checked = FALSE;
            } else {
                $salesArr["manufacture_yr"] = clean_input($salesArr["manufacture_yr"]);
            }

            # Brand
            if (empty(clean_input($salesArr["brand"]))) {
                $brandErr = "Brand is empty";
                $checked = FALSE;
            } else {
                $salesArr["brand"] = brandStandard($salesArr['brand']);
            }
            # Characteristic
            if (sizeof($salesArr["characteristics"]) == 0) {    // Make sure there is at least one characteristic is given in the array
                $characteristicsErr = "Characteristic is empty";
                $checked = FALSE;
            }

            # Conditions
            if (empty(clean_input($salesArr["conditions"]))) {
                $conditionErr = "Condition not selected";
                $checked = FALSE;
            } else {
                $salesArr["conditions"] = clean_input($salesArr["conditions"]);
            }

            /* Seller Information */
            # Name
            if (empty(clean_input($salesArr["name"]))) {
                $nameErr = "Name is empty";
                $checked = FALSE;
            } else {
                $salesArr["name"] = clean_input($salesArr["name"]);
            }
            # Contact Number
            if (empty($salesArr["phone"])) {
                $phoneErr = "Contact is empty";
                $checked = FALSE;
            } else if (!preg_match($phone_pattern, $salesArr["phone"])) {
                $phoneErr = "Invalid phone format";
                $checked = FALSE;
            } else {
                $salesArr["phone"] = clean_input($salesArr["phone"]);
            }
            # Email
            if (empty($salesArr["email"])) {
                $emailErr = "Email is empty";
                $checked = FALSE;
            } else if (!preg_match($email_pattern, $salesArr["email"])) {
                $emailErr = "Invalid email format";
                $checked = FALSE;
            } else {
                $salesArr["email"] = clean_input($salesArr["email"]);
            }
            // Compare year of manufacture and product_id yr
            // If all the mandatory information is entered (Write into 'GearDirectory.txt')
            if ($checked) {
                $salesFile = fopen("GearDirectory.txt", "a");  // Write at the end of the file (create if it does not exist)
                $data = $salesArr["name"] . "::" . $salesArr["phone"] . "::" . $salesArr["email"] . "::" . $salesArr["product_id"] . "::" . $salesArr["category"] . "::" . $salesArr["description"] . "::" . $salesArr["manufacture_yr"] . "::" . $salesArr["brand"];
                foreach ($salesArr['characteristics'] as $key => $value) {
                    $data .= "~~" . $value;
                }
                $data .= $salesArr['status'] . "\n";
                fwrite($salesFile, $data);
                fclose($salesFile);
                echo '<script type = "text/javascript" >
                                alert("You have successfully added an instrument");
            </script>';



                $salesArr = array(
                    'name' => '',
                    'phone' => '',
                    'email' => '',
                    'product_id' => '',
                    'category' => '',
                    'description' => '',
                    'manufacture_yr' => '',
                    'brand' => '',
                    'characteristics' => array(),
                    'conditions' => '',
                    'status' => ''
                );
                $checked = false;
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

        <h2 id="title">Sales of Instrument</h2>
        <!-- Instrument Details -->
        <form class="instrumentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <!-- Basic Information -->
            <div class="sectionDetails" >
                <h4 class="sectionHead">Instrument Basic Information</h4>
                <p class="normalSection"><label class="instrumentLabel" for="product_id">Product ID:</label><input type="text"  name="product_id"  value="<?php echo $salesArr["product_id"]; ?>" class="formText" placeholder="e.g. XXX-0000-00"><span class="error"> <?php echo $product_idErr; ?></span>
                </p>
                <p class="normalSection"><label class="instrumentLabel" for="category">Category:</label>
                    <select id="category" name="category" class="selectOpt" >
                        <option hidden selected value=" ">Select Category</option>
                        <option value="Guitar" <?php
        if ($salesArr['category'] == "Guitar") {
            echo ' selected="selected"';
        }
        ?>>Guitar</option>
                        <option value="Piano" <?php
                        if ($salesArr['category'] == "Piano") {
                            echo ' selected="selected"';
                        }
        ?>>Piano</option>
                        <option value="Ukelele" <?php
                        if ($salesArr['category'] == "Ukelele") {
                            echo ' selected="selected"';
                        }
        ?>>Ukelele</option>
                        <option value="Saxophone" <?php
                        if ($salesArr['category'] == "Saxophone") {
                            echo ' selected="selected"';
                        }
        ?>>Saxophone</option>
                        <option value="Violin" <?php
                        if ($salesArr['category'] == "Violin") {
                            echo ' selected="selected"';
                        }
        ?>>Violin</option>
                        <option value="Trumpet" <?php
                        if ($salesArr['category'] == "Trumpet") {
                            echo ' selected="selected"';
                        }
        ?>>Trumpet</option>
                        <option value="Accordion" <?php
                        if ($salesArr['category'] == "Accordion") {
                            echo ' selected="selected"';
                        }
        ?>>Accordion</option>
                        <option value="Clarinet" <?php
                        if ($salesArr['category'] == "Clarinet") {
                            echo ' selected="selected"';
                        }
        ?>>Clarinet</option>
                    </select><span class="error"> <?php echo $categoryErr; ?>
                </p>
                <p class="descSection"><label class="instrumentLabel"  for ="description">Description:</label><textarea id="desc"  name="description"><?php echo $salesArr["description"]; ?></textarea>
                    <span class="error" id="descErr"> <?php echo $descErr; ?></span>
                </p>
            </div>
            <!-- Details -->
            <div class="sectionDetails">
                <h4 class="sectionHead">Instrument Details</h4>
                <p class="normalSection"><label class="instrumentLabel">Year of manufacture:</label>
                    <select id="manufacture_yr" name="manufacture_yr" class="selectOpt">
                        <?php loadYear($salesArr['manufacture_yr']); ?>
                    </select>
                    <span class="error"> <?php echo $yrErr; ?>
                </p>
                <p class="normalSection"><label class="instrumentLabel">Brand:</label><input type="text" name="brand" class="formText" value="<?php echo $salesArr["brand"]; ?>"><span class="error"> <?php echo $brandErr; ?></span></p>
                <p class="normalSection"><label class="instrumentLabel">(Max: 5) Characteristics:</label>
                    <input type="text"  class="formText" id="characteristicInput">
                    <button type="button" id="addChar" onclick="addCharacteristic()" ><b>Add</b> <span class="fa fa-plus"></span></button> 
                    <span class="error" id="charErr"> <?php echo $characteristicsErr; ?></span>
                </p>
                <p class="charSection">

                    <span id="charDisplay">
                        <?php
                        foreach ($salesArr['characteristics'] as $key => $value) {
                            echo '<script type="text/javascript">createChar("' . $key . '")</script>';
                        }
                        ?>
                    </span>
                </p>

                <p class="normalSection"><label for name="sex" class="instrumentLabel">Conditions:</label>
                    <input type="radio" class="hideRadio" id="new" name="conditions" <?php
                        if ($salesArr["conditions"] == "New") {
                            echo "checked";
                        }
                        ?> value="New"/><label for="new" class="conBtnLabel">New</label>
                    <input type="radio" class="hideRadio" id="used" name="conditions" <?php
                    if ($salesArr["conditions"] == "Used") {
                        echo "checked";
                    }
                        ?> value="Used"/><label for="used" class="conBtnLabel">Used</label>
                    <span class="error"> <?php echo $conditionErr; ?></span>
                </p>
            </div>
            <br/>


            <!-- Seller Information -->
            <div class="sectionDetails">
                <h4 class="sectionHead" align='center'>Seller Information</h4>
                <p class="normalSection"><label class="instrumentLabel" for="name">Name:</label><input type="text" name="name" value="<?php echo $salesArr["name"]; ?>" class="formText"><span class="error"> <?php echo $nameErr; ?></span></p>
                <p class="normalSection"><label class="instrumentLabel">Phone:</label><input type="text" name="phone" value="<?php echo $salesArr["phone"]; ?>" class="formText"><span class="error"> <?php echo $phoneErr; ?></span></p>
                <p class="normalSection"><label class="instrumentLabel">Email: </label><input type="text" name="email" value="<?php echo $salesArr["email"]; ?>" class="formText"  placeholder="example@abc.com"><span class="error"> <?php echo $emailErr; ?></span></p>
            </div>
            <div class="submitBtn">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </body>
</html>
