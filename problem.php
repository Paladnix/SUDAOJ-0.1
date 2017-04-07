<?php

require('head.php');
require("config.php");

$pID = $_GET['pid'];
$status = $_GET['status'];
if($status == "")
	$status = "No submission";
$DB =  new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($DB->connect_error)
{
	header("location:/sudaOJ/Error.php?error=Cant link to the SQL; Please connect the Administrator.");
}
$sql = "select problemName, timeLimit, memoryLimit,submited,accepted,context,input, output, inputCase, outputCase from ProblemLib where pid='$pID';";
$result	 = $DB->query($sql);
	if( $result->num_rows == 0)	
	{
		echo "There is not problem ID = $pID. <br>";
	}
	else
	{
		$row = $result->fetch_assoc();
		echo "<center>";
		echo "<p><font size=+3>".$row['problemName']."</font></p>";
		echo "TimeLimit: ".$row['timeLimit']." ms &nbsp; MemoryLimit: ".$row['memeoryLimit']." Megabyte<br>";
		echo "Totalsubmit: ".$row['submited']." &nbsp; Accepted: ".$row['accepted']."</p>";
		if($status == "Accepted")
			echo '<h3 style="color:green">'.$status."</h3>";
		if($status == "Wrong Answer")
			echo '<h3 style="color:red">'.$status."</h3>";
		if($status == "Compiler Error")
			echo '<h3 style="color:blue">'.$status."</h3>";
		if($status == "TLE")
			echo '<h3 style="color:red">'.$status."</h3>";
		if($status == "MLE")
			echo '<h3 style="color:red">'.$status."</h3>";
		echo "</center>";
		echo "<hr>";

			$context=$row['context'];
			$context=nl2br($context);

			echo '<div class="container">';
			echo '<div class="row">';
			echo '<div class="col-sm-2"></div>';
			echo '<div class="col-sm-8">';	
			echo	'<div class="panel panel-info" style="border-radius:0">';
			echo		'<div class="panel-heading" style="border-top-left-radius:0;border-top-reight-radius:0;height:40px;">';
			echo			'<div class="row">';
			echo				'<div class="col-xs-12 text-left">';
			echo					'<h5 class="smart-margin-off">Description</h5>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo		'<div class="panel-body">';
			echo			'<p><font size=+1>'.$context.'</font></p>';
			echo		'</div>';
			echo	 '</div>';									
			echo '</div>';
			echo '<div class="col-sm-2"></div>';
			echo '</div>';
			echo '</div>';			
			
			$context=$row['input'];
			$context=nl2br($context);

			echo '<div class="container">';
			echo '<div class="row">';
			echo '<div class="col-sm-2"></div>';
			echo '<div class="col-sm-8">';	
			echo	'<div class="panel panel-info" style="border-radius:0">';
			echo		'<div class="panel-heading" style="border-top-left-radius:0;border-top-reight-radius:0;height:40px;">';
			echo			'<div class="row">';
			echo				'<div class="col-xs-12 text-left">';
			echo					'<h5 class="smart-margin-off">Input</h5>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo		'<div class="panel-body">';
			echo			'<p><font size=+1>'.$context.'</font></p>';
			echo		'</div>';
			echo	 '</div>';									
			echo '</div>';
			echo '<div class="col-sm-2"></div>';
			echo '</div>';
			echo '</div>';			

			$context=$row['output'];
			$context=nl2br($context);

			echo '<div class="container">';
			echo '<div class="row">';
			echo '<div class="col-sm-2"></div>';
			echo '<div class="col-sm-8">';	
			echo	'<div class="panel panel-info" style="border-radius:0">';
			echo		'<div class="panel-heading" style="border-top-left-radius:0;border-top-reight-radius:0;height:40px;">';
			echo			'<div class="row">';
			echo				'<div class="col-xs-12 text-left">';
			echo					'<h5 class="smart-margin-off">Output</h5>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo		'<div class="panel-body">';
			echo			'<p><font size=+1>'.$context.'</font></p>';
			echo		'</div>';
			echo	 '</div>';									
			echo '</div>';
			echo '<div class="col-sm-2"></div>';
			echo '</div>';
			echo '</div>';			

			$context=$row['inputCase'];
			$context=nl2br($context);

			echo '<div class="container">';
			echo '<div class="row">';
			echo '<div class="col-sm-2"></div>';
			echo '<div class="col-sm-8">';	
			echo	'<div class="panel panel-info" style="border-radius:0">';
			echo		'<div class="panel-heading" style="border-top-left-radius:0;border-top-reight-radius:0;height:40px;">';
			echo			'<div class="row">';
			echo				'<div class="col-xs-12 text-left">';
			echo					'<h5 class="smart-margin-off">Sample Input</h5>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo		'<div class="panel-body">';
			echo			'<p><font size=+1>'.$context.'</font></p>';
			echo		'</div>';
			echo	 '</div>';									
			echo '</div>';
			echo '<div class="col-sm-2"></div>';
			echo '</div>';
			echo '</div>';			

			$context=$row['outputCase'];
			$context=nl2br($context);

			echo '<div class="container">';
			echo '<div class="row">';
			echo '<div class="col-sm-2"></div>';
			echo '<div class="col-sm-8">';	
			echo	'<div class="panel panel-info" style="border-radius:0">';
			echo		'<div class="panel-heading" style="border-top-left-radius:0;border-top-reight-radius:0;height:40px;">';
			echo			'<div class="row">';
			echo				'<div class="col-xs-12 text-left">';
			echo					'<h5 class="smart-margin-off">Sample Output</h5>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo		'<div class="panel-body">';
			echo			'<p><font size=+1>'.$context.'</font></p>';
			echo		'</div>';
			echo	 '</div>';									
			echo '</div>';
			echo '<div class="col-sm-2"></div>';
			echo '</div>';
			echo '</div>';

	}
mysqli_close($DB);
?>

			<div class="container">
			<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<form role="form" action="submit.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
					<label><input type="file" name="code"></label>
						<label >Compiler</label>
						<select name="compiler">
							<option value="g++" selected="selected">g++</option>
							<option value="javac">javac</option>
							<option value="python3">python3</option>
						</select>
					</div>
					<div class="form-group">
				<?php
					echo '<select name="pid">';
					echo '<option value="'.$ID.'" selected="selected">'.$ID.'</option>';
					echo '</select>';
				?>
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn-md btn-primary" style="margin-left:0px;">Submit</button>
					</div>
				</form>
			</div>
			<div class="col-sm-2"></div>
			</div>
			</div>

<?php
require('foot.php');
?>
