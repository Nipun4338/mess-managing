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
    <h6 class="m-0 font-weight-bold text-primary">Cost Info
    </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_POST['edit_btn_user']))
      {
        $query = "SELECT * FROM cost";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label> Others Cost </label>
                  <input type="number" min="0" name="others"  value="<?php  echo $row['others_cost']; ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label> Meal Cost </label>
                  <input type="number" min="0" name="meal"  value="<?php  echo $row['meal_cost']; ?>" class="form-control">
              </div>
              <a href="cost_info.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="editCost" class="btn btn-primary">UPDATE</button>
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
