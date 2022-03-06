<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
$sql="select distinct user_id, day, night, date from todays_meal group by user_id order by date desc";
$result=mysqli_query($connection,$sql);
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
    array_push($data,$row);
  }
}
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
        <li class="breadcrumb-item active" aria-current="members_meal">Members Meal Info</li>
    </ol>
    </nav>
     <div class="row" style="display: flex;
        align-items: stretch;
        justify-content: space-around;">

        <?php 
            date_default_timezone_set("Asia/Dhaka");
        ?>
        <h3 style="font-weight: bold; text-align: center">Today's Member Meal Info</h3><hr/>
        <div class="table-responsive table table-hover">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Lunch</th>
            <th scope="col">Dinner</th>
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
            <td><?php echo $row1['day']; ?></td>
            <td><?php echo $row1['night']; ?></td>
            <td><p class="card-title" style="font-style: italic;"><?php echo date('M j, Y g:i A', strtotime($row1["date"])) ?></p></td>
            </tr>
            <?php } } } }?>
        </tbody>
        </table>
        </div>



        <h3 style="font-weight: bold; text-align: center">Total Meal Info</h3><hr/>
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
            <th scope="col">Meal Till Now</th>
            <th scope="col">Last Updated</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql3="SELECT * FROM meal";
        $result3=mysqli_query($connection,$sql3);
        $data3=array();
        $noOfRows3=mysqli_num_rows($result3);
        if($noOfRows3){
          while($row3=mysqli_fetch_assoc($result3)){
            array_push($data3,$row3);
          }
        }
       if($noOfRows3)
       {
       foreach ($data3 as $row4) {
      ?>
      <?php 
        $sql4="SELECT * FROM user where user_id='".$row4['user_id']."'";
        $result4=mysqli_query($connection,$sql4);
        $noOfRows4=mysqli_num_rows($result4);
        if($noOfRows4){
        while($row5=mysqli_fetch_assoc($result4)){
        ?>
            <tr>
            <td><?php echo $row5['user_name']; ?></td>
            <td><?php echo $row4['meal_count']; ?></td>
            <td><p class="card-title" style="font-style: italic;"><?php echo date('M j, Y g:i A', strtotime($row4["date"])) ?></p></td>
            </tr>
            <?php } } } }?>
        </tbody>
        </table>
        </div>
     </div>
     </div>
    <script  src="./lunchtime.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>