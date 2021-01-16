<html>
    <head>
        <style type="text/css">
            body{
                padding: 20px;
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
            .errorMsg{
                padding: 20px;
                text-align:center;
            }
        </style>

    </head>
    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $product_id = $_GET["product_id"];
        }
        ?>
        <!-- HTML -->
        <!-- Page Heading Tag --> 
        <h1><center>My Music Gear </center></h1>
        <!-- Navigation -->
        <hr/>
        <ul>
            <li><a href="myMusicGear.php" class ="navi">HOME</a></li>
            <li><a href="#" class="navi">My ORDERS</a></li>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
        </ul>
        <hr/>
        <div class="errorMsg">
            <span><?php echo $product_id . " not found"; ?></span>
        </div>

    </body>
</html>
