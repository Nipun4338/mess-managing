<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM todays_meal where user_id='".$user_id."'";
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
  <link rel="icon" href="Graphicloads-Colorful-Long-Shadow-Diary.ico">
  </head>
  <body id="main">
    <?php
	include('includes/nav.php');
	 ?>
    <div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="todays_meal">Today's Meal</li>
    </ol>
    </nav>
     <div class="row" style="display: flex;
        align-items: stretch;
        justify-content: space-around;">

        <?php 
            date_default_timezone_set("Asia/Dhaka");
        ?>
        <h3 style="font-weight: bold; text-align: center">Set Meal</h3><hr/>
        <form class="form-container" action="code.php" method="POST">
        <?php if(isset($_SESSION['success']) && $_SESSION['success']!='')
    {
        echo '<div class="alert alert-success">
        '.$_SESSION['success'].'
        </div>';
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status']!='')
    {
        echo '<div class="alert alert-danger">
        '.$_SESSION['success'].'
        </div>';
        unset($_SESSION['success']);
    }
     ?>
        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        <p class="card-title" style="text-align: center; font-style: italic;">Last Updated: <?php echo date('M j, Y g:i A', strtotime($row["date"])) ?></p>

        <div class="container">
        <div class="row justify-content-center">
        <div class="card border-success mb-3" style="max-width: 18rem; margin: 20px">
        <div class="card-header bg-transparent border-success" style="font-weight: bold; text-align: center">
        <DIV CLASS="time">
            <P ID="date">--:--:-- --</P>
        </DIV></div>
        <div class="card-body text-success" style="font-weight: bold; text-align: center">
            <h5 class="card-title">Lunch</h5>
            <p class="card-text">Remaining Time:<br />
            <DIV CLASS="time">
            <P ID="time">--:--:-- --</P>
            </DIV>
        </p>
        </div>
        <div class="card-footer bg-transparent border-success"><div class="input-group mb-3">
        <input type="number" min="0" name="lunch"  style="text-align: center" class="form-control" placeholder="Lunch meal count" aria-label="meal-count" aria-describedby="basic-addon1" value=<?php echo $row['day']; ?>>
        </div></div>
        </div>

        <div class="card border-success mb-3" style="max-width: 18rem; margin: 20px">
        <div class="card-header bg-transparent border-success" style="font-weight: bold; text-align: center">
        <DIV CLASS="time">
            <P ID="date2">--:--:-- --</P>
        </DIV></div>
        <div class="card-body text-success" style="font-weight: bold; text-align: center">
            <h5 class="card-title">Dinner</h5>
            <p class="card-text">Remaining Time:<br />
            <DIV CLASS="dinnerTime">
            <P ID="dinnerTime">--:--:-- --</P>
            </DIV>
        </p>
        </div>
        <div class="card-footer bg-transparent border-success"><div class="input-group mb-3">
        <input type="number" min="0" style="text-align: center" name="dinner" class="form-control" placeholder="Dinner meal count" aria-label="meal-count" aria-describedby="basic-addon1" value=<?php echo $row['night']; ?>>
        </div>
      </div>
        </div>
        </div>

        <button type="submit" name="meal" class="btn btn-primary btn-block submit">Submit</button>
        </div>
    </form>
     </div>
     </div>
     <?php } } ?>
    <script  src="./lunchtime.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>