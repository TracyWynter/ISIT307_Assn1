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
            
            /* Background*/
            body{
                 background-image: url("background.jpg");
                 background-repeat: no-repeat;
                 background-size: cover;
            
            }
         </style>
    </head>
    
    <body>
        <!-- Page Heading Tag -->
        <h1><center> Welcome to My Music Gear </center></h1>
        <!-- Navigation -->
        <ul>
            <li><a href="#" class ="navi">HOME</a></li>
            <li><a href="#" class="navi">My ORDERS</a></li>
            <li><a href="#" class="navi">SIGN IN</a></li>
            <li><a href="#" class="navi">REGISTER</a></li>
        </ul>
        
        <!-- Search Submission -->
        <p><center>What are you looking for?</center></p>
        <form class="search" action="searchResult.php">
            <center>
                <input type="text" placeholder="Example:Guitar / Piano / Ukelele .... " name="search">
                <button type="submit"><i class="fa fa-search">Search</i></button>
            </center>
        </form>

    </body>
</html>
