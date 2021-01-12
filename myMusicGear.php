<html>
    <head>
        <title>My Music Gear</title>
        <style type="text/css">
            form.search input[type=text]{
                width: 60%;
                height: 30px;
            }
            form.search button {
                height: 30px;
            }
            
            /* Page Navi Links */
            .navi {
                color: black;
                text-decoration: none;
            }
            .navi:hover {
                color: grey;
            }
            
         </style>
    </head>
    
    <body>
        <!-- Page Heading Tag -->
        <h1><center> Welcome to My Music Gear </center></h1>
        <br /> 
            <body background="background.jpg">
        <br />
        <!-- Navigation -->
        <h3 align = "right">
            <a href="#" class ="navi">HOME</a>
            <a href="#" class="navi">My ORDERS</a>
            <a href="#" class="navi">SIGN IN</a>
            <a href="#" class="navi">REGISTER</a>
        </h3>
        
        <!-- Search Submission -->
        <p><center>What are you looking for?</center></p>
        <form class="search" action="/search.php">
            <center>
                <input type="text" placeholder="Example:Guitar / Piano / Ukelele .... " name="search">
                <button type="submit"><i class="fa fa-search">Search</i></button>
            </center>
        </form>

    </body>
</html>
