 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom:0px;">
      <div class="container">
        <a class="navbar-brand"style="font-size:25px;" href="index.php">EWSD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav navbar-left" style="font-size:18px; padding-left:30px;">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
               
              </a>
            </li>
			<?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role']==1)){ ?>
            <li class="nav-item">
              <a class="nav-link" href="Idea.php">Idea</a>
            </li>
			<?php } ?>
			<?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role']==1 || $_SESSION['user_role']==3)){ ?>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
			<?php } ?>
          
			<?php if(isset($_SESSION['user_role']) && ($_SESSION['user_role']==2 || $_SESSION['user_role']==0)){ ?>
			<li class="nav-item">
              <a class="nav-link" href="admin/index.php">Admin</a>
            </li>
			<?php } ?>
			<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']==3){ ?>
			<li class="nav-item">
              <a class="nav-link" href="admin/coordinator.php">Department</a>
            </li>
			<?php } ?>
          </ul>
		 
		   <?php if (isset($_SESSION['user_role']) ) { ?>
		  <ul class="nav navbar-nav navbar-right"style="font-size:18px;">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout(<?= $_SESSION['username']?>)</a></li>
		  </ul>
		   <?php } else { ?>
		   <ul class="nav navbar-nav navbar-right"style="font-size:18px;">
				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		  </ul>
		  <?php } ?>
        </div>
      </div>
    </nav>

		
			
			 
			
		