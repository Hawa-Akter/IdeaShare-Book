     
<?php
 ?>


	 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Forum</h3>
                <ul class="nav side-menu">
				<li><a href="../index.php"><i class="fa fa-home"></i> Student Index</span></a>
				<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']==0){ ?>
				 
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Index</a></li>
                      <li><a href="addUser.php">Add User</a></li>
                      <li><a href="manage-user.php">Manage User</a></li>
                      <li><a href="addDepartment.php">Add Department</a></li>
                      <li><a href="viewDepartment.php">View Department</a></li>
                      <li><a href="manage-idea.php">Manage ideas</a></li>
                      <li><a href="manageCoordinator.php">Manage Coordinator</a></li>
                    
                      
                    </ul>
                  </li>
				<?php } ?>
				   <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']==2){ ?>
                  <li><a><i class="fa fa-edit"></i>Categories <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="addCategory.php">Add Category</a></li>
                        <li><a href="manage-category.php">Manage Category</a></li>
						<li><a href="downloadZip.php">Download Resources</a></li>
                    </ul>
                  </li>
				   <?php } ?>
				
                 <li><a><i class="fa fa-table"></i> Statistisc<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']==3 && $_SESSION['departmentName']=='BIT'){ ?>
                      <li><a href="BITView.php">BIT</a></li>
					<?php }elseif(isset($_SESSION['user_role']) && $_SESSION['user_role']==3 && $_SESSION['departmentName']=='CSE'){ ?>
                      <li><a href="CSEView.php">CSE</a></li>
					  <?php }elseif(isset($_SESSION['user_role']) && $_SESSION['user_role']==3 && $_SESSION['departmentName']=='IT'){ ?>
                      <li><a href="ITView.php">IT</a></li>
					  <?php }elseif(isset($_SESSION['user_role']) && $_SESSION['user_role']==3 && $_SESSION['departmentName']=='EEE'){ ?>
                      <li><a href="EEEView.php">EEE</a></li>
					  <?php } ?>
					  <?php if(isset($_SESSION['user_role'])&& ($_SESSION['user_role']==2 || $_SESSION['user_role']==0)){ ?>
						<li><a href="BITView.php">BIT</a></li>
						 <li><a href="CSEView.php">CSE</a></li>
						 <li><a href="ITView.php">IT</a></li>
						  <li><a href="EEEView.php">EEE</a></li>
					  <?php } ?>
                    </ul>
                  </li>
				
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                 
			  </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
