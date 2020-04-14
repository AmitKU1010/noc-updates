<?php 

    $page = 'change-password.php';
    $title = 'Change Password | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Session File
	include_once('../resource/session.php');
	
	// Include Database Conncection Script File
	include_once('../resource/database.php');

	// Include Utilities File
	include_once('../resource/utilities.php');

	// redirect user to login page if they're not logged in
	if (empty($_SESSION['id'] || isCookieValid($db))) {
		if($_SESSION['role'] === '2'){
			header('location: ../login.php');
			die;
		}
	}

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
										<a href="index.html" class="btn btn-outline-primary"><< Back</a>
									</div>
	
									<form enctype="multipart/form-data">
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="row">
														<div class="col-6 mx-auto">
															<div class="form-group">
																<label class="form-label">Current Password</label>
																<input type="password" name="current_password" class="form-control" placeholder="Current Password" value="">
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
	
												<input type="hidden" name="hidden_id" class="form-control" value="" >
	
												<input type="hidden" name="token" class="form-control" value="" >										
											
											</div>
										</div>
	
										<div class="card-footer text-right">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<button type="submit" name="mix_change_password" class="btn btn-primary btn-block">Update Password</button>
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