<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<center>
  <br>
  &nbsp;
  <img src="acm.gif">
  <img src="neau.gif">
  <p>
</center>
<?
	require("config.php");
	$DB=mysql_connect("localhost",$dbUserName,$dbPassword);
	mysql_select_db("soj",$DB);
	$DBT=mysql_query("select remarks from status where runID = $rid");
	$DBTrow=mysql_fetch_row($DBT);
	echo nl2br($DBTrow[0]);
?>
</body>
</html>
