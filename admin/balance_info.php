<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="scripts.php" method="POST">
        <div class="modal-body">

            <div class="form-group">
                <label> Deposite </label>
                <input type="number" name="deposite" class="form-control" placeholder="Enter Money">
            </div>
            <div class="form-group">
            <select name="user" class="form-select" class="form-select" aria-label="Default select example">
                <?php 
                    $sqlm="select * from user";
                    $resultm=mysqli_query($connection,$sqlm);
                    $noOfRowsm=mysqli_num_rows($resultm);
                    $data=array();
                    if($noOfRowsm){
                      while($rowm=mysqli_fetch_assoc($resultm)){
                        array_push($data,$rowm);
                    }
                  }
                 if($noOfRowsm)
                 {
                 foreach ($data as $row) {
                ?>
                <option value=<?php echo $row["user_id"] ?>><?php echo $row["user_name"] ?></option>
                <?php }} ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="updateDeposite" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Balance Details
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add User Balance
            </button>
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
      $query = "SELECT * FROM balance";
      $query_run = mysqli_query($connection, $query);
  ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Deposite </th>
            <th>Cost</th>
            <th>Balance</th>
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
                                <td><?php  echo $row['deposite']; ?></td>
                                <td><?php  echo $row['cost']; ?></td>
                                <td><?php  echo $row['balance']; ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["date"])) ?></td>
                                <td>
                                    <form action="balance_edit.php" method="post">
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
