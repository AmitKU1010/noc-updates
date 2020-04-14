<?php 

    $page = 'index.php';
    $title = 'NOC Portal | Powerd by MIXblack';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include SignUp Parse File
	include('partials/parseSignup.php'); 

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
									<h3 class="card-title">Create New Account</h3>
								</div>

								<div class="card-body">
									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>

										<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
									</div>

									<div class="clearfix"></div>

									<form action="registration.php" name="emp_registration" method="post">
										<div class="form-group">
											<label class="form-label text-dark">
												Name
												<span class="text-danger">*</span>
											</label>

											<input type="text" name="name"  value="<?php if(isset($name)) echo $name; ?>" class="form-control" placeholder="Enter full name">
										</div>

										<div class="form-group">
											<label class="form-label text-dark">
												Email ID
												<span class="text-danger">*</span>
											</label>

											<input type="text" name="email" class="form-control" value="<?php if(isset($email)) echo $email; ?>" placeholder="Enter AAI Email ID">
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
												<input type="checkbox" name="terms_condition" class="custom-control-input">
												<span class="custom-control-label text-dark">Agree the <a href="term-and-conditions.php">terms and policy</a></span>
											</label>
										</div>

										<input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

										<div class="form-footer mt-2">
											<button type="submit" name="emp_registration" class="btn btn-primary btn-block">Create New Account</button>
										</div>

										<div class="text-center  mt-3 text-dark">
											Already have account?<a href="<?php echo $url; ?>login.php"> Sign In</a>
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