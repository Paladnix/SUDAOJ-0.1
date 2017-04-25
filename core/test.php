<?php

$sh = "sudo su judge ./Run_c.sh IN ./666 out 1 65535";
exec("$sh 2>&1", $result);

//echo $result."\n";

//var_dump($result);

$len = count($result);

$ret = $result[1];

echo $len."\n".$ret;
?>
