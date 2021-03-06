<?php
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <link href="header.css" rel="stylesheet">
        <script src="header.js"></script>
        <link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet"></link>
    </head>
    <body>
        <div id="header">
        <div id="title">
       <a href="home.php"><h1>Welcome to the Mizzou Item Management System</h1></a>
        </div>
            <ul id="header-items">
<?php
    if(($_SESSION["level"])=="2") {
        echo '<li>Employees';
        echo '<ul class="dropdown">';
        echo '<li><a href="register.php">New Emloyees</a></li>';
        echo '<li><a href="editemployee.php">Edit Permissions</a></li>';
        echo '</ul>';
        echo '<span class="caret"></span>';
        echo '</li>';
    }
    ?>
              <li>Items

                    <ul class="dropdown">

                    <li><a href="add_item.php">Add Item</li>
                     <li><a href="transactions.php">All Transactions</a></li>
                        <li><a href="checkin.php">Check In</a></li>
                        <li><a href="checkout.php">Check Out</a></li>
                        <li><a href="overdue.php">Overdue Items</a></li>
                        <li><a href="renew.php">Renew Item</a></li>
                        <li><a href="items.php">View All Items</a></li>
                    </ul>
                      <span class="caret"></span> 
                </li>
                <li>Locations
                    <ul class="dropdown">
                        <li><a href="add_location.php">Add Location</a></li>
                    </ul>
                    <span class="caret"></span>
                </li>
                <li>Students
                    <ul class="dropdown">
                        
                        <li><a href='addwaiver.php'>Add Waiver</a></li>
                        <li><a href='students.php'> View Students</a></li>
                    </ul>
                    <span class="caret"></span>
                </li>

                <li id="logout" class="nodropdown"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </body>
    
</html>
