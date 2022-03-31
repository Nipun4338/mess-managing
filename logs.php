<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM balance order by date desc";
$result=mysqli_query($connection,$sql);
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
    array_push($data,$row);
  }
}
$left=0;
$meal=0;
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
        <li class="breadcrumb-item"><a href="home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="log">Logs</li>
    </ol>
    </nav>
     <div class="row" style="display: flex;
        align-items: stretch;
        justify-content: space-around;">

        <?php
            date_default_timezone_set("Asia/Dhaka");
        ?>
        <h3 style="font-weight: bold; text-align: center">All Logs</h3><br>
        <?php
        $sqlm="select * from month";
        $resultm=mysqli_query($connection,$sqlm);
        $noOfRowsm=mysqli_num_rows($resultm);
        if($noOfRowsm){
          while($rowm=mysqli_fetch_assoc($resultm)){
        ?>
        <h6 style="text-align: center;"><?php echo $rowm['month_name']; ?>, Day <?php echo $rowm['day']; ?></h6>
        <?php } } ?>
        <div class="table-responsive table table-hover">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Deposite</th>
            <th scope="col">Cost</th>
            <th scope="col">Balance</th>
            <th scope="col">Last Updated</th>
            </tr>
        </thead>
        <tbody>
        <?php
       if($noOfRows)
       {
       foreach ($data as $row1) {
      ?>
      <?php
        $sql1="SELECT * FROM user where user_id='".$row1['user_id']."'";
        $result1=mysqli_query($connection,$sql1);
        $noOfRows1=mysqli_num_rows($result1);
        if($noOfRows1){
        while($row2=mysqli_fetch_assoc($result1)){
        ?>
            <tr>
            <td><?php echo $row2['user_name']; ?></td>
            <td><?php
            $deposite=$row1["deposite"];
            echo $row1['deposite']; ?></td>
            <?php
           $sql="SELECT * FROM meal where user_id='".$row1['user_id']."'";
           $result=mysqli_query($connection,$sql);
           $noOfRows=mysqli_num_rows($result);
           if($noOfRows){
             while($row=mysqli_fetch_assoc($result)){
              $amar=$row["meal_count"];
           ?>
          <?php
           $query1="select sum(meal_count) AS meal_sum from meal";
           $query_run1=mysqli_query($connection, $query1);
           $rows=mysqli_num_rows($query_run1);
           if($rows){
             while($row3=mysqli_fetch_assoc($query_run1)){

           $sql="SELECT * FROM cost";
           $result=mysqli_query($connection,$sql);
           $noOfRows=mysqli_num_rows($result);
           
           if($noOfRows){
             while($row=mysqli_fetch_assoc($result)){
               if($row3["meal_sum"])
               {
                 $meal=$row["meal_cost"]/$row3["meal_sum"];
                 $meal=$meal*$amar;
               }
               else
               {
                 $meal=$row["meal_cost"]/0.001;
                 $meal=$meal*$amar
               }
               $query="select user_id from user order by user_id";
                $query_run=mysqli_query($connection, $query);
                $rowx=mysqli_num_rows($query_run);
                $others=$row["others_cost"]/$rowx;

           ?>

            <td><?php echo number_format((float)$others+$meal, 2, '.', ''); ?></td>

            <?php } } } }?>
            <td><?php
            $left+=number_format((float)$deposite-$others-$meal, 2, '.', '');
            echo number_format((float)$deposite-$others-$meal, 2, '.', ''); ?></td>
            <td><p class="card-title" style="font-style: italic;"><?php echo date('M j, Y g:i A', strtotime($row1["date"])) ?></p></td>
            </tr>
            <?php } } } } }

          }?>
          <tr>
            <td style="font-weight: bold">Balance Left: </td>
            <td></td>
            <td></td>
            <td style="color: green; font-weight: bolder;font-size: 22px"><?php echo $left; ?></td>
            <td></td>
        </tr>
        </tbody>
        </table>
        </div>

        <?php
        $sql="SELECT * FROM cost order by date desc";
        $query_run=mysqli_query($connection,$sql);
        ?>
        <h3 style="font-weight: bold; text-align: center">Cost Logs</h3><br>
        <div class="table-responsive table table-hover">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Others Cost</th>
            <th>Meal Cost</th>
            <th>Last Updated</th>
          </tr>
        </thead>
        <tbody>
          <?php

          if(mysqli_num_rows($query_run) > 0)
          {
              while($row = mysqli_fetch_assoc($query_run))
              {
          ?>
              <tr>
                  <td><?php  echo $row['others_cost']; ?></td>
                  <td><?php  echo $row['meal_cost']; ?></td>
                  <td><?php echo date('M j, Y g:i A', strtotime($row["date"])) ?></td>
              </tr>
          <?php
              }
          }
          else {
              echo "No Record Found";
          }
          ?>
          </tbody>
        </table>
        </div>
     </div>
     </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
