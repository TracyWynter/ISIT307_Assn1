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
    <body>
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
                Name: <input type="text"></br></br>
                Phone: <input type="text"><br/><br/>
                Email: <input type="text" placeholder="example@abc.com"><br/><br/>
            </div>
        </form>
    </body>
</html>
