<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
?>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sure to Clear Month?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Clear" below if you are ready to clear the month.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="test.php" method="POST">

            <button type="submit" name="logout_btn" class="btn btn-primary">Clear</button>

          </form>


        </div>
      </div>
    </div>
  </div>


<div class="container-fluid">

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

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Clear Month?
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal1">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Clear
      </a>
    </div>
    </h6>
  </div>
</div>
<!-- /.container-fluid -->

<?php
include('scripts.php');
include('includes/footer.php');
?>
