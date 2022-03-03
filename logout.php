<?php
session_start();
include('database/dbconfig.php');
//if(isset($_POST['logout_btn']))
  {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    header('Location: login');
  }

?>