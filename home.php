<?php
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: ' . $url);
        //exit;
    }
    session_start();
    $con= mysqli_connect("localhost","public","P@ssword","Project");
    $query0 = "SELECT COUNT(*)
    FROM item_info;";
    $statement0 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement0, $query0)) {
        
        /* execute query */
        mysqli_stmt_execute($statement0);
    }
    $result0 = mysqli_stmt_get_result($statement0);
    $row0 = mysqli_fetch_array($result0, MYSQLI_NUM);
    $itemcount = $row0[0];
    mysqli_stmt_close($statement0);
    
    $query1 = "SELECT COUNT(*)
    FROM transaction_info
    WHERE `transaction_info`.`Checked In Time` IS NULL;";
    $statement1 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement1, $query1)) {
        
        /* execute query */
        mysqli_stmt_execute($statement1);
    }
    $result1 = mysqli_stmt_get_result($statement1);
    $row1 = mysqli_fetch_array($result1, MYSQLI_NUM);
    $opencount = $row1[0];
    mysqli_stmt_close($statement1);
    
    $query2 = "SELECT COUNT(*) FROM transaction_info
    WHERE `transaction_info`.`Checked In Time` IS NULL AND `transaction_info`.`Fine` != 0;";
    $statement2 = mysqli_stmt_init($con);
    if (mysqli_stmt_prepare($statement2, $query2)) {
        
        /* execute query */
        mysqli_stmt_execute($statement2);
    }
    $result2 = mysqli_stmt_get_result($statement2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
    $overdue = $row2[0];
    mysqli_stmt_close($statement2);
    
    mysqli_close($con);
    
    ?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
<title>Home</title>
<style>
#content{
width: 100%;
text-align: center;
}
div#message-bar{
margin: auto;
width: 100%;
}
.nav>li>a:focus, .nav>li>a:hover{
    background-color: #286090 !important;
}
.nav>li>a.btn-info:focus, .nav>li>a.btn-info:hover{
    background-color: #31b0d5 !important;
}
ul.nav.nav-pills{
				margin-left: 30%;
    
}
</style>
<script>
$(document).ready(function(){
                  $("#header").load("header.php");
                  });
</script>
</head>
<body>
<header id="header"></header>
<div id="content" class="container-fluid">
<h1>Welcome <?=$_SESSION["employeeName"]?></h1>
<div id="message-bar">
<ul class="nav nav-pills" role="tablist">
<li role="presentation"><a class="btn btn-info" href="items.php">View Items <span class="badge"><?=$itemcount?></span></a></li>
<li role="presentation"><a class="btn btn-primary" href="transactions.php">Checked Out Items<span class="badge"><?=$opencount?></span></a></li>
<li role="presentation"><a class="btn btn-danger" href="overdue.php">Over Due Items<span class="badge"><?=$overdue?></span></a></li>
</ul>
</div>

</div>
</body>
</html>
