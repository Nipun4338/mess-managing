<nav class = "navbar navbar-expand-lg navbar-light bg-light sticky-top shadow p-3 mb-5 bg-white rounded">

	 <div class="container-fluid">
	 <a href="home" class = "navbar-brand" style="font-weight:bold;">
			Mess
	</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
	</button>
	 <div class="collapse navbar-collapse" id="navbarSupportedContent">
	 <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="padding: 0px 5px 0px 5px;font-weight:bold">
			 <a class="nav-item nav-link" href = "home"> Home </a>
			 <?php if (!isset($_SESSION["user_name"])) {
    		$message= '<a class="nav-item nav-link" href = "login"> LOGIN </a>';
			}
			else {
				$message='
				<a class="nav-item nav-link" href = "todays_meal"> Todays Meal </a>
				<a class="nav-item nav-link" href = "members_meal"> Members Meal Info </a>
				<a class="nav-item nav-link" href = "logs"> Logs </a>
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          '.$_SESSION['user_name'].'
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" name="logout_btn" href="logout">Logout</a>
        </div>';
			}
			echo ($message);?>
	 </ul>
 </div>
</div>
 </nav>