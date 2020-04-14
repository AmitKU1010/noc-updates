<?php 

    $page = 'forgot-password.php';
    $title = 'Forgot Password | NOC App';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Forgot Password File
	include_once('partials/parseForgotPassword.php');

	// Include Header File
	include('include/header.php'); 

?>
		<!--Page-->
		<div class="page mix-login-bg">
			<div class="page-content z-index-10">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
							<div class="mix-logo text-center">
								<a class="header-brand" href="#" target="_blank">
									<img src="<?php echo $url; ?>assets/images/brand/aai.png" class="mix-login-brand-img" alt="AAI">
								</a>
							</div>

							<div class="card mb-0 mix-card-bg">
								<div class="text-center mt-4">
									<h4><b>Reset you password</b></h4>
									<p>An password reset link will be send to your email.</p>
								</div>

								<div class="card-body">
									<form action="forgot-password.php" method="post">
										<!-- Display Messages -->
										<div>									
											<?php if (isset($msg)) { echo $msg; } ?>

											<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
										</div>

										<div class="clearfix"></div>

										<div class="form-group">
											<label class="form-label text-dark">Email address</label>
											<input type="email" name="email" class="form-control" placeholder="Enter Email Id">
										</div>

										<input type="hidden" name="token" class="form-control" value="<?php if(function_exists('_token')) echo _token(); ?>">	

										<div class="form-footer mt-2">
											<button type="submit" name="forgot_password_btn" class="btn btn-primary btn-block">SEND</button>
										</div>

										<div class="text-center  mt-3 text-dark">
											Remember Old Password? <a href="<?php echo $url; ?>login.php">Login</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include('include/footer.php'); ?>  