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
    
    $DB =new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if( $DB->connect_error )
	{
		die("connect fault<br>");
	}
    
    $sql = "insert into contest (cname, timeStart, timeEnd, pw, author) values('$cname','$timeStart','$timeEnd','$pw','$author');select @@INDENTITY as num";
	
	$result = $DB->query($sql);	
    
    if( $result->num_rows > 0 )
	{
		$row = $result->fetch_assoc();
    
        $cid = $row["num"];
	}
    else 
    
        header("Location:contestadd.php");
    
    mysqli_close($DB);
    
    echo $cid;
    
    header("Location:ps.php?cid=$cid&visable=0");
?>
