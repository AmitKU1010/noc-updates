<?php 

    $page = 'change-password.php';
    $title = 'Change Password | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include ParseChangePassword page
	include_once('../partials/parseChangePassword.php');

	// Include ParseProfle page
	include_once('../partials/parseProfile.php');

	include('session-restrict-emplooyee.php');
	


	// redirect user to login page if they're not logged in
	// if (empty($_SESSION['id'] || isCookieValid($db))) {
	// 	if($_SESSION['role'] === '0'){
	// 		header('location: ../login.php');
	// 		die;
	// 	}
	// }

	guard();

	// Include Header File
	include('../include/header.php'); 

?>

		<div class="page">
			<div class="page-main">
				
				<!-- Include Sidebar -->
				<?php include('sidebar.php'); ?>

				<!-- Main Content -->
				<div class="app-content  my-4 my-md-6">
                    <div class="side-app">
                        <div class="page-header">
                            <h4 class="page-title">Change Password</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row mt-4">
							<div class="col-lg-7 col-xl-8 mx-auto">
								<div class="card">
									<div class="card-header">
										<a href="<?php echo $url; ?>employee/profile.php" class="btn btn-outline-primary"><< Back</a>
									</div>
	
									<form action="change-password.php" method="post" enctype="multipart/form-data">
										<div class="card-body">
											<!-- Display Messages -->
											<div>									
												<?php if (isset($msg)) { echo $msg; } ?>

												<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
											</div>

										<div class="clearfix"></div>

											<div class="row">
												<div class="col-12">
													<div class="row">
														<div class="col-md-6 mx-auto">
															<div class="form-group">
																<label class="form-label">Current Password</label>
																<input type="password" name="current_password" class="form-control" placeholder="Current Password" value="<?php if(isset($current_password)) echo $current_password; ?>">
															</div>
														</div>
													</div>
												</div>

												<div class="col-12">
													<div class="row">
														<div class="col-md-6 mx-auto">
															<div class="form-group">
																<label class="form-label">New Password</label>
																<input type="password" name="new_password" class="form-control" placeholder="New Password">
															</div>
														</div>
													</div>
												</div>
												
												<div class="col-12">
													<div class="row">
														<div class="col-md-6 mx-auto">
															<div class="form-group">
																<label class="form-label">Confirm Password</label>
																<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
															</div>
														</div>
													</div>
												</div>

												<input type="hidden" name="hidden_id" class="form-control" value="<?php if(isset($id)) echo $id; ?>" >

												<input type="hidden" name="token" class="form-control" value="<?php if(function_exists('_token')) echo _token(); ?>" >										
											
											</div>
										</div>
	
										<div class="card-footer text-right">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<button type="submit" name="emp_change_password" class="btn btn-primary btn-block">Update Password</button>
												</div>
												<div class="col-md-4"></div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
                        <!-- END CONTENT -->
    
                    </div>
                </div>
			</div>

			<!--footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							Copyright © <?php echo date('Y'); ?> <a href="#">Airports Authority of India</a> All rights reserved. | Designed by <a href="https://www.mixblack.co.in" target="_blank">MIXblack</a> 
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->
		</div>

<?php include('../include/footer.php'); ?> 