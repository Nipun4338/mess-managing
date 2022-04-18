<?php
include("security.php");
include('database/dbconfig.php');
$user_id=$_SESSION['user_id'];
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
        <li class="breadcrumb-item active" aria-current="info">Infos</li>
    </ol>
    </nav>
     <div class="row" style="display: flex;
        align-items: stretch;
        justify-content: space-around;">
        <h3 style="font-weight: bold; text-align: center">All Infos</h3><br>
        <div class="table-responsive table table-hover">
        <?php
            $query = "SELECT * FROM logs order by date desc";
            $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Log Id </th>
            <th> Name </th>
            <th>Meal Count</th>
            <th>Others Cost</th>
            <th>Meal Cost</th>
            <th>Deposite</th>
            <th>Date</th>
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
                <td><?php  echo $row['log_id']; ?></td>
                <?php
                if($row["user_id"]!=0)
                {
                    $query2 = "SELECT * FROM user where user_id='".$row["user_id"]."'";
                    $query_run2 = mysqli_query($connection, $query2);
                    if(mysqli_num_rows($query_run2) > 0)
                    {
                        while($row2 = mysqli_fetch_assoc($query_run2))
                        {
                    ?>
                    <td><?php  echo $row2['user_name']; ?></td>
                    <?php }}}
                    else
                    { ?>
                        <td style="color:blue"><?php echo $row['note']; ?></td>
                        <?php
                    }
                    ?>
                    <td><?php  echo $row['meal_count']; ?></td>
                    <td><?php  echo $row['others_cost']; ?></td>
                    <td><?php  echo $row['meal_cost']; ?></td>
                    <td><?php  echo $row['deposite']; ?></td>
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
