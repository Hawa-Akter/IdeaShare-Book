      <?=$_SESSION['imageName']?>
	  <?php exit(); ?>
	   <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?php if(isset($_SESSION['imageName'])){ ?>
                    <img src="<?=BASE_URL ?><?=$_SESSION['imageName']?>" alt=""> <?php echo $_SESSION['username']?>
						<?php } else{ ?>
					<img src="<?=BASE_URL ?>/Admin/Images/user.png" alt=""> <?php echo $_SESSION['username']?>
						<?php } ?> 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="">Help</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                 </ul>
            </nav>
          </div>
        </div>
        