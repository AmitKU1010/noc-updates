<?php 

    $page = 'reset-password.php';
    $title = 'Reset Password | NOC App';
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
								<div class="card-body">

									<!-- Display Messages -->
									<div>									
										<?php if (isset($msg)) { echo $msg; } ?>

										<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
									</div>

									<div class="clearfix"></div>

									<form action="reset-password.php" method="post">
										<div class="form-group">
											<label class="form-label text-dark">Email</label>
											<input type="text" name="email" class="form-control" placeholder="Enter Email ID">
										</div>

										<div class="form-group">
											<label class="form-label text-dark">Token</label>
											<input type="text" name="reset_token" class="form-control" placeholder="Enter Token">
										</div>

										<div class="form-group">
											<label class="form-label text-dark">New Password</label>
											<input type="password" name="new_password" class="form-control" placeholder="Enter Password">
										</div>

										<div class="form-group">
											<label class="form-label text-dark">Confirm Password</label>
											<input type="password" name="confirm_password" class="form-control" placeholder="Enter Re-password">
										</div>

										<input type="hidden" name="token" class="form-control" value="<?php if(function_exists('_token')) echo _token(); ?>" >	

										<div class="form-footer mt-2">
											<button type='submit' name="reset_password_btn" class="btn btn-primary btn-block">RESET PASSWORD</button>
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