<?php
session_start();
require_once 'config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$passwordrepeat = $_POST["passwordrepeat"];
	$trueName = $_POST["trueName"];
	$email = $_POST["email"];
	$sex = $_POST["sex"];
	$telephone = $_POST["telephone"];
}

if($username ==  "" )
{
	echo "<a href=userregister.html>用户名不能为空</a>";
	return;
}
if( $password	!= $passwordrepeat )
	echo "<a href=userregister.html>密码不一致</a>";
else
{
	$DB =new mysqli("localhost", dbUserName, dbPassword, dbName);
	if($DB->connect_error)
		die("connect fault<br>");

	$sql = "insert into userRegister (username, password, trueName, email, sex,telephoneNumber) values('$username','$password','$trueName','$email','$sex','$telephone')";
	$result = $DB->query($sql);
	if( $result > 0 )
	{
		$_SESSION['uname'] = $username;
		header("Location:index.php");
		echo "Update userRegister successfully.<br>";
	}
	else 
		header("Location:userregisterhtml.php");

	$sql = "insert into rankList (team) values('$username')";
	if(mysqli_query($DB, $sql))
		echo "Update ranklist successfully .<br>";
	else echo "fault<br>";
	mysqli_close($DB);
}
?>

