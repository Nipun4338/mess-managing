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
?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


  <?php

if(isset($_POST['registerbtn']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    if($password == $confirm_password)
    {
	      $password=md5($password);
        $query = "INSERT INTO user (user_name, email, phone, password, user_category) VALUES ('$name','$email','$phone','$password','$category')";
        $query_run = mysqli_query($connection, $query);
        $user_id=mysqli_insert_id($connection);
        $balance="INSERT INTO balance (user_id) VALUES ('$user_id')";
        $query_run1 = mysqli_query($connection, $balance);
        $meal_count="INSERT INTO meal (user_id) VALUES ('$user_id')";
        $query_run2 = mysqli_query($connection, $meal_count);
        $todays_meal="INSERT INTO todays_meal (user_id) VALUES ('$user_id')";
        $query_run3 = mysqli_query($connection, $todays_meal);

        if($query_run)
        {
            echo "done";
            $_SESSION['success'] =  "User is Added Successfully";
            header('Location: userinfo.php');
        }
        else
        {
            echo "not done";
            $_SESSION['status'] =  "User is Not Added";
            header('Location: userinfo.php');
        }
    }
    else
    {
        echo "pass no match";
        $_SESSION['status'] =  "Password and confirm password doesn't match";
        header('Location: userinfo.php');
    }

}

if (isset($_POST["updatebtn"])) {
  $id=$_POST['edit_id'];
  $username=$_POST['edit_username'];
  $email=$_POST['edit_email'];
  $password=md5($_POST['edit_password']);
  $status=$_POST['edit_status'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update adminpanel set username='$username',email='$email',password='$password',status='$status', updated_date='$datetime' where admin_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Your data is updated";
    header('Location: register.php');
  }
  else {
    $_SESSION['success']="Your data is not updated";
    header('Location: register.php');
  }
}


  if (isset($_POST["updatebtnbook"])) {
    $id=$_POST['edit_id_book'];
    $details = $_POST['edit_details'];
    $status = $_POST['edit_status'];
    $mailid=$_POST["mail"];
    $mail_name=$_POST["mail_name"];
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='boi.yourbook@gmail.com';
    $mail->Password='zffwybtbangyivph';
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=587;
    $mail->setFrom('boi.yourbook@gmail.com', 'Boi');
    $mail->isHTML(true);
    $mail->Subject="Regarding Your Book";
    $mail->Body="<h3>Greetings, ".$mail_name."!</h3><br/>
    <p>Your book has been published/changed.</p>
    <p><a href='http://boi-yourbook.herokuapp.com/book?book=".$id."'>Please check it out!</a></p><br/>
    <p>Thank you for being with us!</p><p class='font-weight:bold'>It means a lot!</p><br>
    <h1>Boi</h1>";
    $mail->addBCC($mailid);

    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');

    $query=sprintf("update books set present_condition='%s', status='$status', updated_date='$datetime' where book_id='$id'",
    mysqli_real_escape_string($connection, $details));
    $query_run=mysqli_query($connection, $query);

    if($query_run)
    {
      $mail->send();
      $_SESSION['success']="Book data is updated";
      header('Location: bookinfo.php');
    }
    else {
      $_SESSION['success']="Book data is not updated";
      header('Location: bookinfo.php');
    }


}



if (isset($_POST["updatebtnuser"])) {
  $id=$_POST['edit_id_user'];
  $name=$_POST['user_name'];
  $email=$_POST['user_email'];
  $phone=$_POST['user_phone'];
  $category=$_POST['category'];
  $query="update user set user_name='$name', email='$email', phone='$phone', user_category='$category' where user_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="User data is updated";
    header('Location: userinfo.php');
  }
  else {
    $_SESSION['success']="User data is not updated";
    header('Location: userinfo.php');
  }


}




if (isset($_POST["updateDeposite"])) {
  $id=$_POST['user'];
  $deposite=$_POST['deposite'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update balance b1 set b1.deposite=b1.deposite+'$deposite', date='$datetime' where user_id='$id'";
  $query2="insert into logs(deposite, date) values ('$deposite', '$datetime')";
  $query_run=mysqli_query($connection, $query);
  $query_run2=mysqli_query($connection, $query2);

  if($query_run)
  {
    $_SESSION['success']="Balance Data is updated";
    header('Location: balance_info.php');
  }
  else {
    $_SESSION['success']="Balance Data is not updated";
    header('Location: balance_info.php');
  }


}

if (isset($_POST["editBalance"])) {
  $id=$_POST['edit_id_user'];
  $deposite=$_POST['deposite'];
  $cost=$_POST['cost'];
  $balance=$_POST['balance'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update balance b1 set b1.deposite='$deposite', b1.cost='$cost', b1.balance='$balance', date='$datetime' where user_id='$id'";
  $query2="insert into logs(deposite, date) values ('$deposite', '$datetime')";
  $query_run=mysqli_query($connection, $query);
  $query_run2=mysqli_query($connection, $query2);
  if($query_run)
  {
    $_SESSION['success']="Balance Data is updated";
    header('Location: balance_info.php');
  }
  else {
    $_SESSION['success']="Balance Data is not updated";
    header('Location: balance_info.php');
  }


}


if (isset($_POST["editMeal"])) {
  $id=$_POST['edit_id_user'];
  $meal_count=$_POST['meal_count'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update meal set meal_count='$meal_count', date='$datetime' where user_id='$id'";
  $query_run=mysqli_query($connection, $query);
  $query2="insert into logs(user_id, meal_count, date) values ('$id', '$meal_count', '$datetime')";
  $query_run2=mysqli_query($connection, $query2);
  if($query_run)
  {
    $_SESSION['success']="Meal Data is updated";
    header('Location: meal_info.php');
  }
  else {
    $_SESSION['success']="Meal Data is not updated";
    header('Location: meal_info.php');
  }


}


if (isset($_POST["editAlert"])) {
  $id=$_POST['edit_id_alert'];
  $title=$_POST['alert_name'];
  $status=$_POST['status'];
  $query="update alert set name='$title', status='$status' where alert_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Alert is updated";
    header('Location: alert.php');
  }
  else {
    $_SESSION['success']="Alert is not updated";
    header('Location: alert.php');
  }


}


if (isset($_POST["addCost"])) {
  $others=$_POST['others'];
  $meal=$_POST['meal'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update cost c1 set c1.others_cost=c1.others_cost+'$others', c1.meal_cost=c1.meal_cost+'$meal', date='$datetime'";
  $query_run=mysqli_query($connection, $query);
  $query2="insert into logs(others_cost, meal_cost, date) values ('$others', '$meal', '$datetime')";
  $query_run2=mysqli_query($connection, $query2);

  if($query_run)
  {
    $_SESSION['success']="Cost Data is updated";
    header('Location: cost_info.php');
  }
  else {
    $_SESSION['success']="Cost Data is not updated";
    header('Location: cost_info.php');
  }


}

if (isset($_POST["editCost"])) {
  $others=$_POST['others'];
  $meal=$_POST['meal'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update cost c1 set c1.others_cost='$others', c1.meal_cost='$meal', date='$datetime'";
  $query_run=mysqli_query($connection, $query);
  $query2="insert into logs(others_cost, meal_cost, date) values ('$others', '$meal', '$datetime')";
  $query_run2=mysqli_query($connection, $query2);

  if($query_run)
  {
    $_SESSION['success']="Cost Data is updated";
    header('Location: cost_info.php');
  }
  else {
    $_SESSION['success']="Cost Data is not updated";
    header('Location: cost_info.php');
  }


}


if (isset($_POST["updateMonth"])) {
  $month=$_POST['month'];
  $day=$_POST['day'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update month set month_name='$month', day='$day', date='$datetime'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Month is updated";
    header('Location: month.php');
  }
  else {
    $_SESSION['success']="Month is not updated";
    header('Location: month.php');
  }


}


if(isset($_POST['sendmail']))
{
    $subject=$_POST["subject"];
    $body=$_POST["body"];
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='boi.yourbook@gmail.com';
    $mail->Password='zffwybtbangyivph';
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port=587;
    $mail->setFrom('boi.yourbook@gmail.com', 'Boi');
    $mail->isHTML(true);
    $mail->Subject=$subject;
    $mail->Body=$body;

    $sql="select email from user";
    $query_run1 = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query_run1) > 0)
    {
        while($row = mysqli_fetch_assoc($query_run1))
        {
          $mail->addBCC($row["email"]);
        }
        $mail->send();
        date_default_timezone_set("Asia/Dhaka");
        $datetime = '';
        $datetime=date('Y-m-d H:i:s');
        $query = sprintf("INSERT INTO mail (subject,body,date)
        VALUES ('%s','$body','$datetime')", mysqli_real_escape_string($connection, $subject));
        $query_run = mysqli_query($connection, $query);
    }

    if($query_run)
    {
        echo "done";
        $_SESSION['success'] =  "Mail send Successfully";
        header('Location: mail.php');
    }
    else
    {
        echo "not done";
        $_SESSION['status'] =  "Mail was not send";
        header('Location: mail.php');
    }

}

?>
