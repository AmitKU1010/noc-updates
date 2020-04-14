<?php 

    $page = 'login.php';
    $title = 'NOC Portal | Powerd by MIXblack';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
	include('partials/parseLogin.php'); 
   
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

							<div class="card mb-0">
								<div class="card-header">
									<h3 class="card-title">Login to your Account</h3>
								</div>

								<div class="card-body">

									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>

										<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
									</div>

									<div class="clearfix"></div>

									<form action="login.php" name="emp_login" method="post">
										<div class="form-group">
											<label class="form-label text-dark">
												Email address
												<span class="text-danger">*</span> 
											</label>

											<input type="text" name="email" class="form-control" value="<?php if(isset($email)) echo $email; ?>" placeholder="Enter Enail ID">
										</div>

										<div class="form-group">
											<label class="form-label text-dark">
												Password
												<span class="text-danger">*</span>
											</label>

											<input type="password" name="password" class="form-control" placeholder="Enter Password">
										</div>

										<div class="form-group">
											<label class="custom-control custom-checkbox">
												<a href="<?php echo $url; ?>forgot-password.php" class="float-right small text-dark mt-1">forgot password?</a>
												
												<input type="checkbox" name="remember" class="custom-control-input">
												<span class="custom-control-label text-dark">Remember me</span>
											</label>
										</div>

										<input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

										<div class="form-footer mt-2">
											<button type="submit" name="login_btn" class="btn btn-primary btn-block">Sign In</button>
										</div>

										<div class="text-center  mt-3 text-dark">
											 <a href="<?php echo $url; ?>"><< Back to Home Page</a>
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