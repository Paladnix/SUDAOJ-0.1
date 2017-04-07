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
}
else
    header("Location:Error.php?error=POST message Error. Please try again.");

$contest = $_GET["cid"];
$visable = $_GET["visable"];
if($visable != 0)
    $visable = 1;

$DB =new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if( $DB->connect_error )
    header("Location:Error.php?error=Connect to SQL failed. Please connect adminixtrator.");
$sql = "insert into ProblemLib (problemName, context, inputCase, outputCase,input, output, timeLimit, memoryLimit, author, contest, visable) values ('$proname','$problem','$Sinput','$Soutput','$input','$output','$timeLimit','$memoryLimit','$author','$contest','$visable'); select @@INDENTITY as ID;";

$result = $DB->query($sql);	

$ret = $result->fetch_assoc();
$pid = $ret["ID"];
$fpath = "./problemIO/".$pid;

if(!is_dir($fpath))
{
    if( !mkdir($fpath) )
        header("location:Error.php?error=Can't mkdir for this problem's IN_OUT file.");
}

chmod($fpath, 0777);

$IN = $fpath."/IN";
$OUT = $fpath."/OUT";


if($_FILES["fileIN"]["error"] == 0)
    echo "Upload Succefully<br>";
if($_FILES["fileOUT"]['error'] == 0)
    echo "Upload Succefully<br>";


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


mysqli_close($DB);
header("Location:index.php");
?>
