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
                width:500px;
                margin-left:auto;
                margin-right:auto;
                border:1px solid black;
            }
            .sectionHead{
                text-align:left;

            }
            .sectionDetails p{
                text-align:left;
                float:right;

            }
            input{
                float:left;
            }

        </style>

    </head>
    <body>
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

        <h2>Sales of Instrument</h2>
        <!-- Instrument Details -->
        <form class="instrumentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <div class="sectionDetails">
                <h4 class="sectionHead">Instrument Basic Information</h4>
                <p>Product id: <input type="text"></p>
                <p>Category: <input type="text" placeholder="E.g. Guitar/Violin .."></p>
                <p>Description<textarea width="200px;"></textarea></p>
            </div>
            <div>
                <h4>Instrument Details</h4>
                <p>Year of manufacture:
                    <select>
                        <option value>

                    </select>
                </p>
            </div>


            <!-- Seller Information -->

            <div class="sectionDetails">
                <h4 class="sectionHead">Seller Information</h4>
                <p>Name: <input type="text"></p>
                <p>Phone: <input type="text"></p>
                <p>Email: <input type="text" placeholder="example@abc.com"></p>
            </div>
        </form>
    </body>
</html>
