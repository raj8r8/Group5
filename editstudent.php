<?php
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) { // if user isn't logged in
    header("Location: ./index.php"); // go to Login page
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
                    $("#loader").load("header.php");            
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
<header id="loader"></header>

       <div id="content">
    <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-3"></div>
        <div class="col-md-4 col-sm-4 col-xs-6" id="container">
    <h1>Edit Student</h1>

            <form action="student_edit.php" id="edit" method="POST">
                <label>ID:</label><input class="form-control" type="text" name="id" readonly="readonly" value="<?=$_POST["id"]?>">
                <br/>
                <label>Username:</label><input class="form-control" type="text" readonly="readonly" name="name" value="<?=rtrim($_POST["name"], '/')?>">
                <br/>
                <label>Ban Status:</label>
                    <select class='form-control' name='ban_status' id='ban_status'>
                        <?php
                            $isBanned = intval(rtrim($_POST["isBanned"], '/'));

                            echo "<option value='0' ".($isBanned == 0 ? "selected": "").">Not Banned</option>";
                            echo "<option value='1' ".($isBanned != 0 ? "selected": "").">Banned</option>";
                        ?>
                    </select>
                <div class="row form-group"></div><br/>
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </form>
    </div>
    </div>
        </div>
    </body>
    
</html>
