<?php
session_start();
include('database/dbconfig.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <title>Mess</title>
    <script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/ios/50/000000/home--v3.png">
    <style media="screen">
    body {
      background: #212534;
      color: white;
    }
    </style>
  </head>
  <body>
    <div class="container-fluid" >
      <div class="row">
    		<div class="col-md-12">
          <section class="container">
          	<section class="row">
          		<section class="col-md-12">
          			<form class="form-container" action="code.php" method="POST">
            				<div class="form-group">
            					<h2 style="text-align:center"><b>Login</b></h2>
          						<?php
          								if(isset($_SESSION['status']) && $_SESSION['status'] !='')
          								{
          										echo '<h6 class="bg-danger text-white" style="text-align:center"> '.$_SESSION['status'].' </h6>';
          										unset($_SESSION['status']);
          								}
          						?>
          			    <label for="exampleInputEmail1">Email Address</label>
          			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>
          			  </div>
          			  <div class="form-group">
          			    <label for="exampleInputPassword1">Password</label>
          			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
          			  </div>
          			  <button type="submit" name="login" class="btn btn-primary btn-block submit">Submit</button>
          			</form>
              </section>
          	</section>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>