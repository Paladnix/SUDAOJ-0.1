<?php
	header("Content-tye:text/html; charset=utf-8");
	require_once('config.php');
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$proname = $_POST["proname"];
		$timeLimit = $_POST["timeLimit"];
		$memoryLimit = $_POST["memoryLimit"];
		$problem = $_POST["problem"];
		$input = $_POST["input"];
		$output = $_POST["output"];
		$Sinput = $_POST["Sinput"];
		$Soutput = $_POST["Soutput"];
		$author = $_POST["author"];
		echo $_POST["fileIN"];
	}
	else
	{
		die("Not Post!");
	}
	$contest = $_GET["cid"];
	$visable = $_GET["visable"];
	if($visable != 0)
		$visable = 1;
	$DB =new mysqli("localhost", dbUserName, dbPassword, dbName);
	if( $DB->connect_error )
	{
		die("connect fault<br>");
	}
	$sql = "insert into problemLib (problemName, context, inputCase, outputCase,input, output, timeLimit, memoryLimit, author, contest, visable) values('$proname','$problem','$Sinput','$Soutput','$input','$output','$timeLimit','$memoryLimit','$author','$procontest','$visable');";
	
	$result = $DB->query($sql);	
	if( $result > 0 )
	{
		$sql = "select count(pid) as num from problemLib;";
		$result = $DB->query($sql);
		if( $result->num_rows > 0 )
		{
			$ret = $result->fetch_assoc();
			$pid = $ret["num"];
			$fpath = "../problemIO/".$pid;

			if(!is_dir($fpath))
			{
				if( !mkdir($fpath) )
					echo "mkdir Error<br>";
			}
			chmod($fpath, 0777);
			
			$IN = $fpath."/IN";
			$OUT = $fpath."/OUT";
		
	//		echo $IN."<br>";
	//		echo $OUT."<br>";

			if($_FILES["fileIN"]["error"] == 0)
				echo "Upload Succefully<br>";
			if($_FILES["fileOUT"]['error'] == 0)
				echo "Upload Succefully<br>";

//			echo $_FILES["fileIN"]["tmp_name"]."<br>";
//			echo $_FILES["fileOUT"]["tmp_name"]."<br>";

			if(!move_uploaded_file($_FILES["fileIN"]["tmp_name"], $IN))
				echo "Upload file Failed!<br>";
			else
				echo "Upload file Successfully!<br>";

			if(!move_uploaded_file($_FILES['fileOUT']['tmp_name'],$OUT))
				echo "Upload file Failed!<br>";
			else
				echo "Upload file Successfully!<br>";
			
			$fpathin = $fpath.$_FILES['fileIN']['name'];
			$fpathout = $fpath.$_FILES['fileOUT']['name'];

			$sql = "update problemLib set filein='$IN' , fileout='$OUT' where pid='$pid';";
			$result = $DB->query($sql);
		}
	}
	else 
		header("Location:ps.php");
	mysqli_close($DB);
	header("Location:index.php");
?>
