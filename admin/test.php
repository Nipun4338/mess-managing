<?php
include('database/dbconfig.php');
$sql="DELETE * from logs";
$result=mysqli_query($link,$sql) or die(mysqli_error($link));
if($result)
  {
    echo "Log is deleted!";
  }
?>
