<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link href="header.css" rel="stylesheet">
        <script src="header.js"></script>
        <style>
            #logoutform {
                float: right;
            }

            #registerform {
                float: right;
            }

            .guiBtn {
                color: black;
                font-size: 20;
                font-family: "Arial";
                background-color: gold;
                padding: 5px;
                border-radius: 5px;
                margin-right: 10px;
                border: 1px solid black;
            }
            .guiBtn:hover {
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <div id="header">
        <div id="title">
        <h1>Welcome to the Mizzou Item Management System</h1>
        </div>

        <?php
            $login_information = "Please enter username and password to login";
            $has_login = false;
            // start the session
            session_start();
            if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
               $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
               header('Location: ' . $url);
                //exit;
            }

            // check the session variable, if exist, get them
            if(isset($_SESSION["username"]))
                $user_name = $_SESSION["username"];
        //  if(isset($_SESSION["user_type"]))
            //  $user_type = $_SESSION["user_type"];

            if(isset($user_name)) {
                // show navigation items + logoutBtn
        ?>
            <ul id="header-items">
                <li>Items
                    <ul class="dropdown">
                        <li>Check In</li>
                        <li><a href="checkout.php">Check Out</a></li>
                        <li><a href="test.html">Edit Items</a></li>
                        <li><a href="items.php">View All Items</a></>
                        <li><a href="transactions.php">All Transactions</a></li>
                    </ul>
                </li>
                <li>Locations
                    <ul class="dropdown">
                        <li>Edit Locations</li>
                    </ul>
                </li>
                
            </ul>
            <form id='logoutform' action="logout.php" method="POST">
                <div class='guiBtn' onclick="document.getElementById('logoutform').submit();">Logout</div>
            </form>
        <?php
            } else {
        ?>
            <form id='registerform' action="register.php" method="POST">
                <div class='guiBtn' onclick="document.getElementById('registerform').submit();">Register</div>
            </form>
        <?php
            }
        ?>
        </div>
    </body>
    
</html>
