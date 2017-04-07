
<?php
session_start();
require_once("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST["password"];
}
#echo $dbUserName.$dbPassword.$dbName."<br>";
#echo $username.$password;
$DB=new mysqli("localhost", dbUserName, dbPassword, dbName);

if($DB->connect_error)
	die("Connect Error ". $DB->connect_error);
$sql= "select password from userRegister where username='".$username."';";
$ret = $DB->query($sql);


if( $username == "" )
	echo "<a href=userlogin.html>用户名或密码不正确，请重新登录</a>";
else  
{
	if($ret->num_rows > 0 )
	{
		$row = $ret->fetch_assoc();
		echo $row["password"];
		if($row["password"] == $password )
		{
			$_SESSION["uname"] = $username;
			header("Location:index.php");
		}
	}
	else
	{
		header("Location:userlogin.php");
	}

}
mysqli_close($DB);
?>
