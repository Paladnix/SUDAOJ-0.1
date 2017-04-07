<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<center>
  &nbsp;
  <img src="acm.gif">
  <img src="neau.gif">
<p><font size=+3>Problem Status List</font><br>
<table width=90% border=0>
 <tbody>
  <tr>
   <td align=middle width=10% bgcolor=blue height=35><font color=white size=+1>Run ID</font></td>
   <td align=middle width=10% bgcolor=blue height=35><font color=white size=+1>Problem</font></td>
   <td align=middle width=20% bgcolor=blue height=35><font color=white size=+1>Judge Status</font></td>
   <td align=middle width=10% bgcolor=blue height=35><font color=white size=+1>Time</font></td>
   <td align=middle width=10% bgcolor=blue height=35><font color=white size=+1>Memory</font></td>
   <td align=middle width=10% bgcolor=blue height=35><font color=white size=+1>Compiler</font></td>
   <td align=middle width=17% bgcolor=blue height=35><font color=white size=+1>Author</font></td>
   <td align=middle width=13% bgcolor=blue height=35><font color=white size=+1>Submit Time</font></td>
  </tr>
  <tr></tr>
   <?
		require("config.php");
		
		if(!isset($pno))
		  	$pno=0;
		
		$from = $pno * 20;
		$to = $to + 21;
		$DB=mysql_connect("localhost",$dbUserName,$dbPassword);
		mysql_select_db("soj",$DB);
		$DBT=mysql_query("select runID,problemID,judgeStatus,rtime,rmemory,compiler,author,submitTime from status order by runID desc limit $from, $to");
		$DBTrownum=mysql_num_rows($DBT);
		
		if($DBTrownum < 21)
			$tag = false;
		else
		{
			$tag = true;
			$DBTrownum -= 1;
		}
							
		for($t=0;$t<$DBTrownum;$t++)
		{
			if($t%2==0)
				$bc=lightblue;
			else
				$bc=eeeeee;
			$DBTrow=mysql_fetch_row($DBT);
			$plink=$DBTrow[1];
			if($plink<=$problemNumber && $plink>0)
				$plink="<a href=problem.php?id=$plink>$plink</a>";
			$judgeStatus = $DBTrow[2];
			if($judgeStatus == "Compile Error")
			{
				$judgeStatus = "<a href=compileerror.php?rid=$DBTrow[0]>$judgeStatus</a>";
			}
			echo "<tr>";
			echo "<td align=middle width=10% bgcolor=$bc><font size=+1>$DBTrow[0]</font></td>";
			echo "<td align=middle width=10% bgcolor=$bc><font size=+1>$plink</font></td>";
   			echo "<td align=middle width=20% bgcolor=$bc><font size=+1>$judgeStatus</font></td>";
   			echo "<td align=middle width=10% bgcolor=$bc><font size=+1>$DBTrow[3]</font></td>";
   			echo "<td align=middle width=10% bgcolor=$bc><font size=+1>$DBTrow[4]</font></td>";
   			echo "<td align=middle width=10% bgcolor=$bc><font size=+1>$DBTrow[5]</font></td>";
   			echo "<td align=middle width=17% bgcolor=$bc><font size=+1>$DBTrow[6]</font></td>";
   			echo "<td align=middle width=13% bgcolor=$bc><font size=+1>$DBTrow[7]</font></td>";
  			echo "</tr>";
		}
		mysql_close($DB);
   
   ?>
 </tbody>
</table>
<p>
<?
	if($tag)
	{
		$tpno = $pno + 1;
		echo "<a href=status.php?pno=$tpno>[Previous Page]</a>";
	}
	if($pno > 0)
	{
		$tpno = $pno - 1;
		echo "&nbsp;&nbsp;";
		echo "<a href=status.php?pno=$tpno>[Next Page]</a>";
	}
?>
	<p><a href=index.php>[Return to Contest]</a></p>
</center>
</body>
</html>