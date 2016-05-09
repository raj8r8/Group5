<!DOCTYPE html>
<html>
<head>
<title></title>

</head>
<?php
    $login_information = "Please enter username and password to login";
    $has_login = false;
    $_SESSION["loggedin"] = false;
    // start the session
    session_start();
    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('Location: ' . $url);
        //exit;
    }
    
    // check the session variable, if exist, get them
    if(isset($_SESSION["username"])){
    $user_name = $_SESSION["username"];
    }
    if(isset($user_name)){
    $has_login = true;
    $_SESSION["loggedin"] = true;
    }
    else
    {
        // check if we have got someting from the html form
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $user_name = $_POST['username'];
            $password = $_POST['password'];
            $db = mysqli_connect("localhost", "public", "P@ssword", "Project")
            or die("Connect Error " . mysqli_error($link));
            
            $sql_query = 'SELECT employee.salt, employee.hashed_pass, employee_has_permissions.permissions_id,
             employee.username, employee.id,employee.name_first,employee.name_last
            FROM employee 
            INNER JOIN employee_has_permissions
            ON employee.id=employee_has_permissions.employee_id 
            WHERE employee.username = ?';
            if($stmt = $db->prepare($sql_query)){
                $stmt->bind_param("s", $user_name);
             mysqli_stmt_execute($stmt);
                $result0 = mysqli_stmt_get_result($stmt);
                $row0 = mysqli_fetch_array($result0, MYSQLI_NUM);

            }
            $salt = $row0[0];
            $pwhash = $row0[1];
            
            // chech the password validation
            if(password_verify($salt.$password, $pwhash)){
                $has_login = true;
                $_SESSION["loggedin"] = true;
                // store the login information to the session
                $_SESSION["username"] = $row0[3];
                $_SESSION["id"] = $row0[4];
                $_SESSION["employeeName"] = $row0[5]." ".$row0[6];
                $_SESSION["level"] = $row0[2];
                $_SESSION["location"] = $_POST["location"];
                $level = $row0[2];
            }
            else{
                // username of password must be wrong
                $login_information = "Wrong username or password!";
            }
            // close the database connection
            $db->close();
        }
    }
    
    // to determine what part it is going to load
    if($has_login) {
        // check the user type
        if($level == "2"){
            header("location: topadminuser.php");
        }
        else if($level == '1'){
            header("location: adminuser.php");
        }
        else if($level == '0'){
            header("location: checkout.php");
        }
        
    }
    
    ?>

<body>

<?php
    echo $login_information;
    
    ?>
</body>
</html>

