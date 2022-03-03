<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Meal Details
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
      $query = "SELECT * FROM meal";
      $query_run = mysqli_query($connection, $query);
  ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Meal Count </th>
            <th>Date</th>
            <th>EDIT </th>
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
                                <?php 
                                $query2 = "SELECT * FROM user where user_id='".$row["user_id"]."'";
                                $query_run2 = mysqli_query($connection, $query2);
                                if(mysqli_num_rows($query_run2) > 0)
                                {
                                    while($row2 = mysqli_fetch_assoc($query_run2))
                                    {
                                ?>
                                <td><?php  echo $row['user_id']; ?></td>
                                <td><?php  echo $row2['user_name']; ?></td>
                                <?php }} ?>
                                <td><?php  echo $row['meal_count']; ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["date"])) ?></td>
                                <td>
                                    <form action="meal_edit.php" method="post">
                                        <input type="hidden" name="edit_id_user" value="<?php echo $row['user_id']; ?>">
                                        <button type="submit" name="edit_btn_user" class="btn btn-success"> EDIT</button>
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
