<?php
require("config.php");
require('head.php');
$ID = $_GET['id'];
$DB = new mysqli('localhost', dbUserName, dbPassword, dbName);
  if($DB->connect_error)
  {
	  header("Location:Error.php");
  }	
$sql = "select cname, timeStart, timeEnd from contest where cid='$ID';";

$ret = $DB->query($sql);
$row = $ret->fetch_assoc();
?>
<div class="container">
<div class="col-md-4"></div>
<div class="col-md-4">
	<h2><?php echo $row['cname']; ?></h2>
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
							<th width=10%></th><th width=10%></th><th width=60%>Problem list</th><th width=20%></th>
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

	$sql_1 = "select distinct pid from status where author='$uname' and judgeStatus='Accepted';";
	$result_1 = $DB->query($sql_1);
	$AC = array();
	if($result_1->num_rows > 0)
		while($row = $result_1->fetch_assoc())
		{
			$AC[] = $row['pid'];
		}
	$AClen = count($AC);

	$sql ="select pid, problemName, ratio, accepted, submited from problemLib where contest='$ID' order by pid;";
	$resoult = $DB->query($sql);
	while( $row = $resoult->fetch_assoc())
	{
		$flag ="";
		for( $i=0; $i < $AClen; $i++)
			if($AC[$i] == $row['pid'])
			{
				$flag = "Yes";
			}

		$ID = $row['pid'];
		$pid = $row['pid'];
		$pname = $row['problemName'];
		echo "<tr>";
		echo "<td>".$flag."</td>";
		echo '<td><a href="problem.php?id='.$ID.'">'.$pid.'</a></td>';
		echo '<td><a href="problem.php?id='.$ID.'">'.$pname.'</a></td>';
		echo "<td>".$row['accepted']."/".$row['submited']." - ".$row['ratio']."</td>";

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
