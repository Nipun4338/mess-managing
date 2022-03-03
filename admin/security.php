<?php
session_start();
include('database/dbconfig.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if(!isset($_SESSION['username']) || $_SESSION['category']!='Admin')
{
    header('Location: login.php');
}
?>
