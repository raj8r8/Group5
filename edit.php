<?php
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
    header("Location: /"); // go to Login page
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
                    $("#loader").load("header.html");            
             });
        </script>
        <style> 
        h1{
            text-align: center;
        }
        #content{
            text-align: center;
        }
        </style>
    </head>
    <body>
<header id="loader">
        </header>
    

       <div id="content">
    <h1>Edit An Item</h1>
            <form action="item_edit.php" id="edit">
                <label>ID:</label><input type="text" name="id">
                <br/>
               <label>Name:</label><input type="text" name="name">
                 <br/>
                <label>Condition:</label>
            <select name="condition" form="edit">
                <option value="1">Functional</option>
                <option value="2">Broken</option>
            </select>
                 <br/>
                <label>Category:</label>
            <select name="category" form="edit">
                <option value="1">Mac</option>
                <option value="2">PC</option>
                <option value="3">Bike</option>
                <option value="4">Mac Charger</option>
                <option value="5">PC Charger</option>
            </select>
                 <br/>
            <input type="submit" value = "submit">
            </form>
        </div>
    </body>
    
</html>
