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
    <h6 class="m-0 font-weight-bold text-primary">Alert Info
    </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_POST['edit_btn_alert']))
      {
        $id=$_POST['edit_id'];
        $query = "SELECT * FROM alert WHERE alert_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="edit_id_alert" value="<?php echo $id?>">
              <div class="form-group">
                  <label> Alert Title </label>
                  <input type="text" name="alert_name"  value="<?php  echo $row['name']; ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label>Status</label>
                <select name="status" class="form-select" class="form-select" aria-label="Default select example">
                <option value=<?php echo $row['status']; ?> ><?php echo $row['status']; ?></option>
                <option value="0">0</option>
                <option value="1">1</option>
              </select>              
            </div>
              <?php
            } }
        ?>
              <a href="alert.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="editAlert" class="btn btn-primary">UPDATE</button>
            </form>
    </div>
  </div>

  </div>

<?php
include('scripts.php');
include('includes/footer.php');
?>
