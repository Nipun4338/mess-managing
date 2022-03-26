<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM balance where user_id='".$user_id."'";
$result=mysqli_query($connection,$sql);
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Mess</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="card.css">
  <link rel="stylesheet" href="sidebar.css">
  <link rel="icon" type="image/x-icon" href="https://img.icons8.com/ios/50/000000/home--v3.png">
  </head>
  <body id="main">
    <?php
	include('includes/nav.php');
	 ?>
    <div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="home">Home</li>
    </ol>
    </nav>
     <div class="row" style="display: flex;
        align-items: stretch;
        justify-content: space-around;">
        <?php 
          $sql="SELECT * FROM alert where status=1";
          $r=mysqli_query($connection,$sql);
          $no=mysqli_num_rows($r);
          if($no){
            while($ro=mysqli_fetch_assoc($r)){
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $ro['name']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <?php } } ?>
           <div>
           <p id="runOut"></p>
            </div>
       <?php
       if($noOfRows)
       {
         $deposite=$row["deposite"];
        ?>
        <h3 style="text-align: center">Your Dashboard</h3><br>
       <div class="card">
         <div class="container-fluid">
           <div class="title">
             <p style="font-weight: bold">Deposite: <span style="color: green; font-weight: bolder;font-size: 30px"><?php echo $row["deposite"]; ?></span> BDT</p>
           </div>
           <?php $date=date('M j, Y g:i A', strtotime($row["date"])); ?>
           <?php
           $sql="SELECT * FROM meal where user_id='".$user_id."'";
           $result=mysqli_query($connection,$sql);
           $noOfRows=mysqli_num_rows($result);
           if($noOfRows){
             while($row=mysqli_fetch_assoc($result)){
           ?>
           <div class="story ellipsis">
           <p style="font-weight: bold">Total meal: <span style="color: green; font-weight: bolder;font-size: 30px"><?php 
             $amar=$row["meal_count"];
             echo $row["meal_count"]; ?></span></p>
           </div>
           <?php }} ?>
           <?php
           $query1="select sum(meal_count) AS meal_sum from meal";
           $query_run1=mysqli_query($connection, $query1);
           $row2=mysqli_num_rows($query_run1);
           if($row2){
             while($row3=mysqli_fetch_assoc($query_run1)){

           $sql="SELECT * FROM cost";
           $result=mysqli_query($connection,$sql);
           $noOfRows=mysqli_num_rows($result);
           if($noOfRows){
             while($row=mysqli_fetch_assoc($result)){
               $per=$row["meal_cost"]/$row3["meal_sum"];
               $meal=$per*$amar;
           ?>
           <div class="story ellipsis">
           <p style="font-weight: bold">Per Meal Rate: <span style="color: green; font-weight: bolder;font-size: 30px"><?php echo number_format((float)$per, 2, '.', ''); ?></span> BDT</p>
           </div>
           <div class="story ellipsis">
           <p style="font-weight: bold">Meal Cost: <span style="color: green; font-weight: bolder;font-size: 30px"><?php echo number_format((float)$meal, 2, '.', ''); ?></span> BDT</p>
           </div>
           <?php
            $query="select user_id from user order by user_id";
            $query_run=mysqli_query($connection, $query);
            $row1=mysqli_num_rows($query_run);
            $others=$row["others_cost"]/$row1;
           ?>
           <div class="story ellipsis">
           <p style="font-weight: bold">Others Cost: <span style="color: green; font-weight: bolder;font-size: 30px"><?php echo number_format((float)$others, 2, '.', ''); ?></span> BDT</p>
           </div>
           <div class="story ellipsis">
           <p style="font-weight: bold">Total Cost: <span style="color: green; font-weight: bolder;font-size: 30px"><?php echo number_format((float)$others+$meal, 2, '.', ''); ?></span> BDT</p>
           </div>
           <div class="story ellipsis">
           <p style="font-weight: bold">Balance: <span style="color: green; font-weight: bolder;font-size: 30px"><?php
           $balance=number_format((float)$deposite-$others-$meal, 2, '.', '');
           if($balance<=0)
           { ?>
            <script>
            document.getElementById("runOut").innerHTML = '<p class="alert alert-danger" style="text-align: center; font-weight: bold">Your balance has run out! Please deposite money to the meal manager!</p>';            
            </script>
            <?php
           } ?>
           <?php
           echo $balance; ?></span> BDT</p>
           </div>
           <?php }}}} ?>
           <div class="date">
             <p style="font-style: italic">Last Updated: <?php echo $date; ?></p>
           </div>
         </div>
        </div>

         <?php } }
          }
        ?>
     </div>
     </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
