<?php
require('config.php');
require('head.php');
?>

<div class="container">
<div class="col-md-4"></div>
<div class="col-md-4">
	<h2> Problem List</h2>
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
							<th width=10%>Solved</th><th width=10%>ProID</th><th width=60%>Problem Name</th><th width=20%>AC/Submit</th>
						</tr>
					</thead>
					<tbody>

<?php
  $DB=new mysqli( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if($DB->connect_error)
  {
      header("Location:Error.php?error=Can't link to the SQL; Please connect the Administrator.&code=1");
  }
    $sql_1 = "select distinct pid from Status where author='$uname' and judgeStatus='Accepted' order by pid;";
	$result_1 = $DB->query($sql_1);
	$sql ="select pid, problemName, ratio, accepted, submited from ProblemLib where visable=1 order by pid;";
    $resoult = $DB->query($sql);
    $row_1 = "";
    $flag = "";
	while( $row = $resoult->fetch_assoc())
    {
        if($row_1 == "")
        {
            if( $resoult_1)
            {
                $row_1 = $result_1->fetch_assoc();
                if($row_1['pid'] == $row['pid'])
                {
                    $flag = "Yes";
                    $row_1 = "";
                }
                else $flag = "";
            }
            else
            {
                $flag = "";   
            }
        }
        else if($row_1['pid'] == $row['pid'])
        {
            $flag = "Yes";
            $row_1 = "";
        }
        else $flag = "";

        $ID = $row['pid'];
		$pid = $row['pid'];
        $pname = $row['problemName'];
    
		echo "<tr>";
		echo "<td>".$flag."</td>";
		echo '<td><a href="/sudaOJ/problem.php?pid='.$ID.'">'.$pid.'</a></td>';
		echo '<td><a href="/sudaOJ/problem.php?pid='.$ID.'">'.$pname.'</a></td>';
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
