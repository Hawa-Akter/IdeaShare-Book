
<?php include_once'Mastering/header.php'; ?>
<?php 
session_start();
if (isset($_SESSION['user_role'])){
	header('location:index.php');
}

?>
    <!-- Navigation -->
<?php include 'Mastering/nav-bar.php'; ?>
    <!-- Page Content -->
<div class="container-fluid" >
        <div class="row" >
			<div class="col-md-6 col-md-offset-3" style="margin-top:40px;">
				<div class="panel panel-login" style=" background-color:#F5F5F5;">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12" >
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<h4 class="text-center text-success"><?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                        ?></h4>
						</div>
						<hr>
					</div>
					<div class="panel-body" >
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="loginChecker.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php if(isset($_SESSION['emailofLogin'])){echo $_SESSION['emailofLogin'];};unset ($_SESSION['emailofLogin']); ?>">
										<h5 class="text-danger"><?php if (isset($_SESSION['emailError'])) {echo ($_SESSION['emailError']);unset ($_SESSION['emailError']);}?></h5>
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="password" tabindex="2" class="form-control" placeholder="Password">
										<h5 class="text-danger"><?php if (isset($_SESSION['passError'])) {echo ($_SESSION['passError']);unset ($_SESSION['passError']);}?></h5>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="registered.php" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit"   name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
								
							</div>
							
						</div>
					</div>
					

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- snipp1 -->

<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script>$(function() {

    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});



</script>

				</div>
			</div>
		</div>
	</div>
	  <?php include_once'Mastering/footer.php';?>
  <?php include_once'Mastering/foot-scripts.php';?>