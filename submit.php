<?php
session_start();

if(!isset($_SESSION['uname']))
	header("Location:userlogin.php");
else $uname = $_SESSION['uname'];

require('config.php');

$pid = $_GET['pid'];
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$compiler = $_POST['compiler'];
}
else 
{
    header("location:Error.php?error=There is something error. Please submit again.");
}

$DB = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($DB->connect_error)
    header("Location:Error.php?error=Can't link to the SQL; Please connect the Administrator.&code=1");

$time = date("h:i:sa-Y-m-d");

$sql = "insert into Status (problemID, submitTime, author, compiler) values ('$pid','$time','$uname','$compiler'); select @@IDENTITY as ID;";

$result = $DB->query($sql);
$row = $result->fetch_assoc();

$runID = $row['ID'];

mkdir("userCode");
chmod("userCode", 0777);

$fpath = "userCode/".$runID."/";

echo $fpath."<br>";

	if(!is_dir($fpath))
	{
		if(!mkdir($fpath))
			echo "Make dir Error<br>";
	}
	chmod($fpath, 0777);

	if($compiler == "g++")
		$codefile = $runID.".cpp";
	else if($compiler == "javac" )
		$codefile = "Main.java";
	else if($compiler == 'python3')
		$codefile = $runID.".py";
	else  $codefile = 1;

	echo $codefile."<br>";
	
	if(!move_uploaded_file($_FILES['code']['tmp_name'], $fpath.$codefile))
		echo "Upload file failed.<br>";
	else echo "Upload file success.<br>";

// 修改题目提交数据
	$sql = "update ProblemLib set submited=submited+1 where pid = '".$pid."';";
	$result = $DB->query($sql);
	if($result <= 0)
	{
		echo "Update Submit Error<br>";
		header("Location:problemlist.php");
	}


// Judge
// 
// 
	$codefile = $fpath.$codefile;

	$sh = $compiler." ".$codefile;

	passthru($sh, $result);
	if($result != 0)
	{
		$status = "Compiler Error";
		header("Location:problem.php?id=$pid&status=$status");
	}

	$sh = "cat problemIO/".$pid."/IN | ./a.out | cat > ".$fpath."out";

	passthru($sh, $result);
	if($result != 0)
	{
		$status = "Runtime Rrror";
		header("Location:problem.php?id=$pid&status=$status");
	}

	$sh = "diff problemIO/".$pid."/OUT ".$fpath."out";
	passthru($sh, $result);
	if($result != 0)
	{
		$status = "Wrong Answer";
		header("Location:problem.php?id=$pid&status=$status");
	}
	else 
	{
		$status= "Accepted";

		$sql = "update problemLib set accepted=accepted+1 where pid = '".$pid."';";
    	$result = $DB->query($sql);
    	if($result <= 0)
    	{
    		echo "Update Submit Error<br>";
    		header("Location:problemlist.php");
    	}
    	$sql = "update problemLib set ratio=accepted/submited where pid = '".$pid."';";
    	$result = $DB->query($sql);
    	if($result <= 0)
    	{
    		echo "Update Submit Error<br>";
	    	header("Location:problemlist.php");
    	}
		header("Location:problem.php?id=$pid&status=$status");
    }
?>
