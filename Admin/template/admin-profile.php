
            <div class="profile clearfix">
              <div class="profile_pic">
			  <?php if(isset($_SESSION['imageName'])){ ?>
                <img src="<?=BASE_URL?><?=$_SESSION['imageName']?>" height="60px" width="100px" alt="..." class="img-circle profile_img">
              <?php }else{ ?>
				<img src="<?=BASE_URL?>Admin/Images/user.png" height="60px" width="100px" alt="..." class="img-circle profile_img">
			  <?php } ?>
			  </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['username']?></h2>
              </div>
            </div>
            