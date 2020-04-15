<?php 

    $page = 'create-request.php';
    $title = 'Create Request | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
    include('../partials/parseCreateRequest.php'); 
 
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
                            <h4 class="page-title">Create Request</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Create Request</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row">
                            <div class="col-lg-6 col-xl-7 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Clearance Certificate Form</h3>
                                    </div>
    
                                    <div class="card-body">
										<!-- Display Messages -->
										<div>									
											<?php if (isset($msg)) { echo $msg; } ?>

											<?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
										</div>

										<form class="form-horizontal" action="create-request.php" method="post">
											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Request Purpose
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<select class="form-control" name="purpose" id="purpose" value="<?php if(isset($purpose)) echo $purpose; ?>">
															<option value="">Select Mode</option>
															<option value="Superannuation">Superannuation</option>
															<option value="Transfer">Transfer</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															<span class="purposeDisplay"></span> letter No.
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="letter_no" class="form-control" value="<?php if(isset($letter_no)) echo $letter_no; ?>" placeholder="Enter Letter No.">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															<span class="purposeDisplay"></span> Letter Date
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="date" name="letter_date" value="<?php if(isset($letter_date)) echo $letter_date; ?>" class="form-control" data-inputmask="'mask': '99/99/9999'">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															<span class="purposeDisplay"></span> Due Date
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="date" name="due_date" value="<?php if(isset($due_date)) echo $due_date; ?>" class="form-control" data-inputmask="'mask': '99/99/9999'">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Employee Number
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="emp_no" class="form-control" value="<?php if(isset($emp_no)) echo $emp_no; ?>" placeholder="Enter Employee No.">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Name
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="name" class="form-control" value="<?php if(isset($name)) echo $name; ?>" placeholder="Enter Full Name">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Designation
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="designation" class="form-control" value="<?php if(isset($designation)) echo $designation; ?>" placeholder="Enter Designation">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Department/Section
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="department" class="form-control" value="<?php if(isset($department)) echo $department; ?>" placeholder="Enter Department/Section">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Email Id
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="email" name="email" class="form-control" value="<?php if(isset($email)) echo $email; ?>" placeholder="Enter Email Id">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Mobile Number
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="phone" class="form-control" value="<?php if(isset($phone)) echo $phone; ?>" placeholder="Enter Mobile No.">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Reporting Officer Name
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="rep_name" class="form-control" value="<?php if(isset($rep_name)) echo $rep_name; ?>" placeholder="Enter Full Name">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Reporting Officer Designation
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="rep_designation" class="form-control" value="<?php if(isset($rep_designation)) echo $rep_designation; ?>" placeholder="Enter Designation">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Reporting Officer <br> Email Id
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="email" name="rep_email" class="form-control" value="<?php if(isset($rep_email)) echo $rep_email; ?>" placeholder="Enter Email Id">
													</div>
												</div>
											</div>

											<div class="form-group ">
												<div class="row">
													<div class="col-md-4">
														<label class="form-label">
															Reporting Officer <br> Moblie No.
															<span class="text-danger">*</span>
														</label>
													</div>

													<div class="col-md-8">
														<input type="text" name="rep_phone" class="form-control" value="<?php if(isset($rep_phone)) echo $rep_phone; ?>" placeholder="Enter Mobile No.">
													</div>
												</div>
											</div>

											<div class="form-group row justify-content-end">
												<div class="col-md-8 float-right">
													<label class="custom-control custom-checkbox">
														<input type="checkbox" name="terms_condition" class="custom-control-input" />
														<span class="custom-control-label text-dark">I agree</span>
													</label>
												</div>
											</div>

											<!-- newly added field -->
											<input type="hidden" name="id" value="<?php echo $id; ?>">

											<input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

											<div class="form-group mb-0 row justify-content-end">
												<div class="col-md-8 float-right mt-4">
													<?php if ($update == true): ?>
                                                        <button type="submit" name="update_submit_request_btn" class="btn btn-primary waves-effect waves-light">
															<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
															Update Request
														</button>
                                                    <?php else: ?>
                                                        <button type="submit" name="submit_request_btn" class="btn btn-primary waves-effect waves-light">
															<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
															Submit Request
														</button>
                                                    <?php endif ?>
												</div>
											</div>
										</form>

                                    </div>
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