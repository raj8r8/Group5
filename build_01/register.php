<?php

$name=$_POST['username'];
$password=$_POST['password'];

$db = mysqli_connect("localhost", "root", "ZSJWDJfam2013", "lab8")
		or die("Connect Error " . mysqli_error($link));

if($name==""|| $password=="")
{
	echo "username or password cannot be empty";
}
else
{

        if ($name != "adminUser" && $password !="admin"){
            $stmt = $db->prepare("insert into user values(?, ?, ?, 'user')");
        }
        else{
            $stmt = $db->prepare("insert into user values(?, ?, ?, 'admin')");
        }

		mt_srand();
		$salt = mt_rand();

		$pwhash = password_hash($salt . $password, PASSWORD_BCRYPT);


		$stmt->bind_param("sss", $name, $salt, $pwhash);
		$result = $stmt->execute();

    	if(!$result)
    	{
    		echo "register failed!";
    		echo "<a href='index.php'>return</a>";
    	}

        else
    	{
    		echo "register successful!";
			echo "<a href='index.php'>Home Page</a>";
    	}
		// close the database connection
		$db->close();
   // }
}
?>
