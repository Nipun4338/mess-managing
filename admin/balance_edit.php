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
    <h6 class="m-0 font-weight-bold text-primary">Balance Info
    </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_POST['edit_btn_user']))
      {
        $id=$_POST['edit_id_user'];
        $query = "SELECT * FROM user WHERE user_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="edit_id_user" value="<?php echo $id?>">
              <div class="form-group">
                  <label> User name </label>
                  <input type="text" name="user_name"  value="<?php  echo $row['user_name']; ?>" class="form-control" disabled>
              </div>
              <?php
            }
          }
          $query = "SELECT * FROM balance WHERE user_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
        ?>
              <div class="form-group">
                  <label>Deposite</label>
                  <input type="number" name="deposite"  value="<?php  echo $row['deposite']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                  <label>Cost</label>
                  <input type="number" name="cost"  value="<?php  echo $row['cost']; ?>" class="form-control" >
              </div>

              <div class="form-group">
                  <label>Balance</label>
                  <input type="number" name="balance"  value="<?php  echo $row['balance']; ?>" class="form-control" >
              </div>

              <a href="balance_info.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="editBalance" class="btn btn-primary">UPDATE</button>
            </form>
            <?php
            }
          ?>
    </div>
  </div>

  </div>

<?php
include('scripts.php');
include('includes/footer.php');
?>
