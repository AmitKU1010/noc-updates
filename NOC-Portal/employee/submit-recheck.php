<?php 

    $page = 'submit-recheck.php';
    $title = 'Submit Re-check | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
    include('../partials/parseCreateRequest.php'); 

	// Include ParseProfle page
	include_once('../partials/parseProfile.php');
	include('session-restrict-admin.php');


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
                            <h4 class="page-title">Submit Re-check</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Submit Re-check</li>
                            </ol>
                        </div>

                        <!-- START CONTENT -->
                        <div class="row mt-4">
							<div class="col-lg-7 col-xl-8 mx-auto">
								<div class="card">
									<div class="card-header">
										<a href="recheck-request.php" class="btn btn-outline-primary"><< Back</a>
									</div>
	
									<?php $tr_id = $_GET['id']; ?>  

                                    <form action="submit-recheck.php?id=<?php echo $tr_id; ?>" method="post">
										<div class="card-body">
											<div class="row">
												<div class="col-12">
													<div class="row">
														<div class="col-6 mx-auto">
															<div class="form-group">
																<label class="form-label">Upload Document</label>
																<input class="form-control" type="file" name="document">
															</div>
														</div>
													</div>
												</div>

												<div class="col-12">
													<div class="row">
														<div class="col-md-6 mx-auto">
															<div class="form-group">
																<label class="form-label">Description</label>
																<textarea required class="form-control" name="discription" rows="4" placeholder="Type..."></textarea>
															</div>
														</div>
													</div>
												</div>									
											</div>
										</div>
	
										<div class="card-footer text-right">
											<div class="row">
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<button type="submit" name="submit_resubmit_btn" class="btn btn-primary btn-block">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
                                                    Submit
                                                    </button>
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