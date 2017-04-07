<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<?
	require("config.php");
			//检查题号是否正确
	if($pid>$problemNumber || $pid<=0)
	{
		echo "<a href=problemlist.php>No Such Problem</a>";
		return;
	}
	$DB=mysql_connect("localhost",$dbUserName,$dbPassword);
	mysql_select_db("soj",$DB);
	$DBT=mysql_query("select password from userRegister where username='$username'");
	$DBTrow=mysql_fetch_row($DBT);
	//身份验证
	if($password!=$DBTrow[0] || $password=="" || $username=="")
		echo "<a href=submit.php?id=$pid>用户名或密码不正确</a>";
	else
	{
		$st=date("G:i:s");  //submit time
		//get the suffix for each compiler: c=>.c, c++=>.cpp java=>.java pascal=>.pas
		switch($compiler)
		{
		case "C++":
			$suffix=".cpp";	
			break;
		case "C":
			$suffix=".c";
			break;
		case "Java":
			$suffix=".java";
			break;
		case "Pascal":
			$suffix=".pas";
			break;
		default: 
			break;
		}		

		mysql_query("insert into status (problemID, author, compiler,submitTime) values('$pid','$username','$compiler','$st')");
		//get runID
		$DBT=mysql_query("select runID from status where author='$username' and submitTime='$st'");
		$DBTrow=mysql_fetch_row($DBT);
		$rid=$DBTrow[0];
		$sourceCode=stripslashes($sourceCode);
		$fp=fopen("./judge/src/$rid$suffix","w");
		fwrite($fp,$sourceCode);
		fclose($fp);
		
		mysql_query("update status set judgeStatus='Waiting' where runID = $rid");

		//更新 problemLib 提交次数和比例统计
		$DBT=mysql_query("select accepted, submited from problemLib where pid=$pid");
		$DBTrow=mysql_fetch_row($DBT);
		$submited=$DBTrow[1]+1;
		$accepted=$DBTrow[0];
		//calculate ratio
		if($accepted==0)
			$ratio=0;
		else
			$ratio=$accepted/$submited;
		//write back the updated information
		mysql_query("update problemLib set ratio=$ratio, submited=$submited where pid=$pid");
		//更新 rankList 表中的提交次数统计
		mysql_query("update rankList set submitTimes_$pid=submitTimes_$pid-1 where team='$username'");			
		echo "<a href=problemlist.php>操作成功</a>";
	}
	mysql_close($DB);
?>
</body>
</html>
