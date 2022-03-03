<?php
include('database/dbconfig.php');
include("security.php");


if (isset($_POST["login"])) {
    $email_login=$_POST['email'];
    $password_login=md5($_POST['password']);
    $query="select * from user where email='$email_login' and password='$password_login'";
    $query_run=mysqli_query($connection, $query);
    $data=array();
    $noOfRows=mysqli_num_rows($query_run);
    if($noOfRows){
        while($row=mysqli_fetch_assoc($query_run)){
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['user_name']=$row['user_name'];
            $_SESSION['username']=$email_login;
        }
        header('Location: home');
    }
    else {
      $_SESSION['status']="Email id / Password is invalid";
      header('Location: login');
    }
  }


  
if (isset($_POST["meal"])) {
  $user_id=$_POST['user_id'];
  $day=$_POST['lunch'];
  $night=$_POST['dinner'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update todays_meal set day='$day', night='$night', date='$datetime' where user_id='$user_id'";
  $query_run=mysqli_query($connection, $query);
  if($query_run)
  {
    $_SESSION['success']="Today's meal is updated";
    header('Location: todays_meal');
  }
  else {
    $_SESSION['success']="Today's meal is not updated";
    header('Location: todays_meal');
  }
}


?>