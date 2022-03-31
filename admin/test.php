<?php
if(!isset($_SESSION))
{
    include("security.php");
}
include('database/dbconfig.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$sql="DELETE from logs";
$result=mysqli_query($link,$sql) or die(mysqli_error($link));
date_default_timezone_set("Asia/Dhaka");
$datetime = '';
$datetime=date('Y-m-d H:i:s');
$query="update balance b1 set b1.deposite=0, date='$datetime'";
$query_run=mysqli_query($connection, $query);
$query2="update meal set meal_count=0, date='$datetime'";
$query_run2=mysqli_query($connection, $query2);
$query3="update cost c1 set c1.others_cost=0, c1.meal_cost=0, date='$datetime'";
$query_run3=mysqli_query($connection, $query3);
if($result && $query_run && $query_run2 && $query_run3)
  {
    $_SESSION['success']="Month Cleared!";
    header('Location: clear.php');
  }
  else {
    $_SESSION['success']="Month not cleared!";
    header('Location: clear.php');
  }
?>
