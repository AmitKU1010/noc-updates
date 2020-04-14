<?php 

    $page = 'pending-request.php';
    $title = 'Pending Request | NOC App';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
	include('../partials/parseCreateRequest.php'); 
	
	// Include ParseProfle page
	include_once('../partials/parseProfile.php');

	include('session-restrict-hod.php');


	// redirect user to login page if they're not logged in
	// if (empty($_SESSION['id'] || isCookieValid($db))) {
	// 	if($_SESSION['role'] === '1'){
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
                            <h4 class="page-title">Pending Request</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Pending Request</li>
                            </ol>
                        </div>

						<!-- START CONTENT -->
                        <div class="row mt-4">

							<!-- Pending Request -->
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto">
                                <div class="card">
									<div class="card-header">
										<h5>Pending Request</h5>
									</div>
                                    <div class="card-body">
										<?php 

											$user_id = $_SESSION['id'];

											// Create SQL SELECT Statement
											$sql = "SELECT * FROM tracker INNER JOIN request on tracker.req_id = request.req_id WHERE tracker.hod_id = $user_id AND tracker.status = 'Pending' AND tracker.recheck = '0'";

											// Use PDO Prepared to sanitize data
											$stmt = $db->prepare($sql);

											$stmt->execute();

											$result = $stmt->fetchAll();

										?>  

										<div class="table-responsive">
											<table id="example" class="table table-striped table-bordered" >
												<thead>
													<tr>
														<th>#</th>
														<th>Purpose</th>
														<th>Letter No.</th>
														<th >Letter date</th>
														<th >Due Date</th>
														<th >Employee No.</th>
														<th >Name</th>
														<th >Designation</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
                                                        
                                                        $i = 1;

                                                        if (!empty($result)) {

                                                            foreach($result as $row) {
                                                    ?>

														<tr class="text-center">
															<th scope="row"><?php echo $i++; ?></th>
															<td><?php echo $row['purpose']; ?></td>
															<td><?php echo $row['letter_no']; ?></td>
															<td><?php echo $row['letter_date']; ?></td>
															<td><?php echo $row['due_date']; ?></td>
															<td><?php echo $row['emp_no']; ?></td>
															<td><?php echo $row['name']; ?></td>
															<td><?php echo $row['designation']; ?></td>
															<td>
																<a href="single-pending-request.php?id=<?php echo $row['req_id']; ?>" class="btn btn-primary btn-sm mb-2" title="View">
																	<i class="fa fa-eye" aria-hidden="true"></i>
																</a>

																<a href="pending-request.php?approve=<?php echo $_SESSION['id'] ?>" class="btn btn-success btn-sm mb-2" onclick="return confirm('Are you sure?');" title="Approve">
																	<i class="fa fa-check" aria-hidden="true"></i>
																</a>

																<a href="#" class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#reCheckRequest" title="Re-check">
																	<i class="fa fa-refresh" aria-hidden="true"></i>
																</a>

																<a href="pending-request.php?delete=<?php echo $_SESSION['id'] ?>" onclick="return confirm('Are you sure?');" title="Delete" class="btn btn-light btn-sm text-danger">
																	<i class="fa fa-times" aria-hidden="true"></i>
																</a>
															</td>
														</tr>

													<?php 
                                                
                                                            }
                                                        }
                                                    
                                                    ?>
												</tbody>

												<tfoot>
													<tr>
														<th>#</th>
														<th>Purpose</th>
														<th>Letter No.</th>
														<th >Letter date</th>
														<th >Due Date</th>
														<th >Employee No.</th>
														<th >Name</th>
														<th >Designation</th>
														<th>Action</th>
													</tr>
												</tfoot>
											</table>
										</div>
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

		<!-- ================================ MODAL ======================== -->
			<!-- View Request Modal -->
			<div class="modal fade" id="viewRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<?php 

							$user_id = $_SESSION['id'];

							// Create SQL SELECT Statement
							$sql = "SELECT * FROM tracker INNER JOIN request on tracker.req_id = request.req_id WHERE tracker.hod_id = $user_id";

							// Use PDO Prepared to sanitize data
							$stmt = $db->prepare($sql);

							$stmt->execute();

							$result = $stmt->fetchAll();

						?>

							<div class="modal-header pd-x-20">
								<h6 class="modal-title">Request No. = #<?php echo $row['req_id']; ?></h6>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body pd-20">
															
								<div class="table-responsive">
									<table class="table table-bordered border-top mb-0">
										<tbody>

											<?php

												if (!empty($result)) {

													foreach($result as $row) {
											
											?>
											<tr>
												<th>Request For</th>
												<td><?php echo $row['purpose']; ?></td>
											</tr>

											<tr>
												<th>Transfer Letter No.</th>
												<td><?php echo $row['letter_no']; ?></td>
											</tr>

											<tr>
												<th>Transfer Letter Date</th>
												<td><?php echo $row['letter_date']; ?></td>
											</tr>

											<tr>
												<th>Transfer Due Date</th>
												<td><?php echo $row['due_date']; ?></td>
											</tr>

											<tr>
												<th>Employee No.</th>
												<td><?php echo $row['emp_no']; ?></td>
											</tr>

											<tr>
												<th>Name</th>
												<td><?php echo $row['name']; ?></td>
											</tr>

											<tr>
												<th>Designation</th>
												<td><?php echo $row['designation']; ?></td>
											</tr>

											<tr>
												<th>Department/Section</th>
												<td><?php echo $row['department']; ?></td>
											</tr>

											<tr>
												<th>Email Id</th>
												<td><?php echo $row['email']; ?></td>
											</tr>

											<tr>
												<th>Mobile No.</th>
												<td><?php echo $row['phone']; ?></td>
											</tr>

											<tr>
												<th>Reporting Office Name</th>
												<td><?php echo $row['rep_name']; ?></td>
											</tr>

											<tr>
												<th>Reporting Office Designation</th>
												<td><?php echo $row['rep_designation']; ?></td>
											</tr>

											<tr>
												<th>Reporting Office Email Id</th>
												<td><?php echo $row['rep_email']; ?></td>
											</tr>

											<tr>
												<th>Reporting Office Mobile No.</th>
												<td><?php echo $row['rep_phone']; ?></td>
											</tr>

											<?php if (!empty($row['comments']) && !empty($row['document']) && !empty($row['emp_comts'])){ ?>

												<tr>
												<th>Comments</th>
													<td><?php echo $row['comments']; ?></td>
												</tr>

												<tr>
													<th>Documents</th>
													<td><?php echo $row['document']; ?></td>
												</tr>

												<tr>
													<th>Employee Discription</th>
													<td><?php echo $row['emp_comts']; ?></td>
												</tr>

											<?php } ?>

											<?php 
																	
													}
												}
											
											?>
										</tbody>
									</table>
								</div>
							</div><!-- modal-body -->

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Re-check Request Modal -->
			<div class="modal fade" id="reCheckRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content ">
						<div class="modal-header pd-x-20">
							<h6 class="modal-title">Request No. = #<?php echo $row['req_id']; ?></h6>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						
						<form action="pending-request.php" method="post">
						
							<div class="modal-body pd-20">
								<div class="form-group">
									<label class="col-form-label">Comments</label>
									<textarea required class="form-control" name="comments" rows="4" placeholder="Description..."></textarea>
								</div>
							</div><!-- modal-body -->

							<div class="modal-footer">
								<button type="submit" name="submit_recheck_btn" class="btn btn-primary mr-3">
									<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp;
									Submit
								</button>
								<button type="button" class="btn btn-light text-danger" data-dismiss="modal">Close</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		<!-- ================================ MODAL ======================== -->

<?php include('../include/footer.php'); ?>  