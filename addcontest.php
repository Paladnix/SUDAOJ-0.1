<?php
	header("Content-tye:text/html; charset=utf-8");
	require_once('config.php');
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$cname = $_POST["cname"];
		$timeStart = $_POST["timeStart"];
		$timeEnd = $_POST["timeEnd"];
		$pw = $_POST["pw"];
	}
	else
	{
		die("Not Post!");
	}
	echo $timeStart."<br>".$timeEnd."<br>";
	$author = $_SESSION['uname'];
	$DB =new mysqli("localhost", dbUserName, dbPassword, dbName);
	if( $DB->connect_error )
	{
		die("connect fault<br>");
	}
	$sql = "insert into contest (cname, timeStart, timeEnd, pw, author) values('$cname','$timeStart','$timeEnd','$pw','$author');";
	
	$result = $DB->query($sql);	
	if( $result > 0 )
	{
		$sql = "select count(cid) as num from contest;";
		$result = $DB->query($sql);
		if( $result->num_rows > 0 )
		{
			$ret = $result->fetch_assoc();
			$cid = $ret["num"];
		}
	}
	else 
		header("Location:contestadd.php");
	mysqli_close($DB);
	echo $cid;
	header("Location:ps.php?cid=$cid&visable=0");
?>
