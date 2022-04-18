<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');

if(isset($_REQUEST['delete']))
{
  $user=$_POST["log_id"];
  $sql="DELETE from logs where log_id='$user'";
  $result=mysqli_query($link,$sql) or die(mysqli_error($link));
  if($result)
  {
    $_SESSION['success']="Log is deleted!";
  }
}
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Logs
    </h6>
  </div>

  <div class="card-body">
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success']!='')
    {
      echo '<h2>'.$_SESSION['success'].'</h2>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status']!='')
    {
      echo '<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
      unset($_SESSION['status']);
    }
     ?>

    <div class="table-responsive">
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
            <th>Action</th>
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
                    $query2 = "SELECT * FROM user where user_id='".$row["user_id"]."'";
                    $query_run2 = mysqli_query($connection, $query2);
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
                        <td><?php echo $row['note']; ?></td>
                        <?php
                    }
                    ?>
                    <td><?php  echo $row['meal_count']; ?></td>
                    <td><?php  echo $row['others_cost']; ?></td>
                    <td><?php  echo $row['meal_cost']; ?></td>
                    <td><?php  echo $row['deposite']; ?></td>
                    <td><?php echo date('M j, Y g:i A', strtotime($row["date"])) ?></td>
                    <td>
                    <form class="form-container" action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="log_id" value="<?php echo $row["log_id"] ?>">
                        <button type="submit" id="submit" name="delete"  class="btn btn-danger btn-block submit2">DELETE</button>
                    </form>
                </td>
                </tr>
            <?php
                }
            }
            else {
                echo "No Record Found";
            }
            ?>
          <!--<tr>
            <td> 1 </td>
            <td> Funda of WEb IT</td>
            <td> funda@example.com</td>
            <td> *** </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>-->

        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('scripts.php');
include('includes/footer.php');
?>
