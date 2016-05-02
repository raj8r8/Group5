<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link href="header.css" rel="stylesheet">
        <script src="header.js"></script>
    </head>
    <body>
        <div id="header">
        <div id="title">
        <h1>Welcome to the Mizzou Item Management System</h1>
        </div>
            <ul id="header-items">
                <li>Items
                    <ul class="dropdown">
                        <li>Check In</li>
                        <li><a href="checkout.php">Check Out</a></li>
                        <li><a href="test.html">Edit Items</a></li>
                        <li><a href="items.php">View All Items</a></li>
                        <li><a href="transactions.php">All Transactions</a></li>
                    </ul>
                </li>
                <li>Locations
                    <ul class="dropdown">
                        <li>Edit Locations</li>
                    </ul>
                </li>
                
            </ul>
        </div>

        <div>
            <form action="item_edit.php" id="edit">
                ID:<input type="text" name="id">
                Name:<input type="text" name="name">
            
            <select name="condition" form="edit">
                <option value="1">Functional</option>
                <option value="2">Broken</option>
            </select>
            
            <select name="category" form="edit">
                <option value="1">Mac</option>
                <option value="2">PC</option>
                <option value="3">Bike</option>
                <option value="4">Mac Charger</option>
                <option value="5">PC Charger</option>
            </select>
            <input type="submit" value = "submit">
            </form>
        </div>
    </body>
    
</html>