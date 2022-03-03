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
    <h6 class="m-0 font-weight-bold text-primary">User Info
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
                  <input type="text" name="user_name"  value="<?php  echo $row['user_name']; ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="user_email"  value="<?php  echo $row['email']; ?>" class="form-control" >
              </div>
              <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="user_phone"  value="<?php  echo $row['phone']; ?>" class="form-control" >
              </div>

              <div class="form-group">
              <select name="category" class="form-select" class="form-select" aria-label="Default select example">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
              </select>
              </div>

              <a href="userinfo.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="updatebtnuser" class="btn btn-primary">UPDATE</button>
            </form>
            <?php
            }
          }
        ?>
    </div>
  </div>

  </div>

<?php
include('scripts.php');
include('includes/footer.php');
?>
