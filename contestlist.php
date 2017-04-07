<?php
require("config.php");
require('head.php');
?>
<div class="container">
<div class="col-md-4"></div>
<div class="col-md-4">
	<h2> Contest List</h2>
</div>
<div class="col-md-4"></div>
</div>
<div class="container">
<div class="col-md-12">
	<div class="lt-tables">
		<div class="lt-box">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead style="color:white; " bgColor=#01010FF>
						<tr>
						<th width=70%>Contest</th><th width=15%>TimeStart</th><th width=15%>TimeEnd</th>
						</tr>
					</thead>
					<tbody>

<?php

  $DB=new mysqli("localhost",dbUserName,dbPassword, dbName);
  if($DB->connect_error)
  {
	  header("Location:Error.php");
  }	
	if(isset($_SESSION["uname"]))
		$uname = $_SESSION['uname'];
	else $uname = "";

	$sql ="select cname, timeStart, timeEnd, cid from contest order by timeStart DESC;";
	$result = $DB->query($sql);
	while( $row = $result->fetch_assoc() )
	{
		$timeStart = $row['timeStart'];
		$timeEnd = $row['timeEnd'];
		$cname = $row['cname'];
		$ID = $row['cid'];

		echo "<tr>";
		echo '<td><a href="contest.php?id='.$ID.'">'.$cname.'</a></td>';
		echo '<td>'.$timeStart.'</td>';
		echo '<td>'.$timeEnd.'</td>';
	    echo '<td class="actions-hover actions-fade"><a href=""><i class="fa fa-pencil"></i></a><a href="" class="delete-row"><i class="fa fa-trash-o"></i></a></td>';
		echo "</tr>";
	}
	mysql_close($DB);
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	
</div>	
<?php
require_once('foot.php');
?>
