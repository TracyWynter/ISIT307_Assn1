<html>
    <head>
        <title>Sales of Instrument</title>
        <style type="text/css">
            body{
                padding: 20px;
                text-align:center;
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
            .sectionDetails{
                text-align:left;
                
            }
            
        </style>

    </head>
    <body>

        <h2>Sales of Instrument</h2>
        <!-- Instrument Details -->
        <form class="instrumentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <div class="sectionDetails">
                <h4 class="sectionHead">Instrument Basic Information</h4>
                <div>
                    <p>Product id: <input type="text"></p>
                    <p>Category: <input type="text" placeholder="E.g. Guitar/Violin .."></p>
                    <p>Description<textarea width="200px;"></textarea></p>
                </div>
            </div>


            <!-- Seller Information -->
            <div>
                <h4 class="sectionHead">Seller Information</h4>
                <div class="sectionDetails">
                    <p>Name: <input type="text"></p>
            </div>
        </form>
    </body>
</html>
