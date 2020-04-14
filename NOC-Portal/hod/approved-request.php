<?php 

    $page = 'approved-request.php';
    $title = 'Approved Request | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include ParseProfle page
	include_once('../partials/parseProfile.php');

	// redirect user to login page if they're not logged in
	if (empty($_SESSION['id'] || isCookieValid($db))) {
		if($_SESSION['role'] === '1'){
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
                            <h4 class="page-title">Approved Request</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Approved Request</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row mt-4">
							<!-- Approved Data -->
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto">
                                <div class="card">
									<div class="card-header">
										<h5>Approved List</h5>
									</div>
                                    <div class="card-body">

										<?php 

											$user_id = $_SESSION['id'];

											// Create SQL SELECT Statement
											$sql = "SELECT * FROM tracker INNER JOIN request on tracker.req_id = request.req_id WHERE tracker.hod_id = $user_id AND tracker.status = 'Approved'";

											// Use PDO Prepared to sanitize data
											$stmt = $db->prepare($sql);

											$stmt->execute();

											$result = $stmt->fetchAll();

										?> 

										<div class="table-responsive">
											<table id="example" class="table table-striped table-bordered" >
												<thead>
													<tr>
														<th class="wd-15p">#</th>
														<th class="wd-15p">Approval Date</th>
														<th class="wd-20p">Letter No.</th>
														<th class="wd-15p">Letter date</th>
														<th class="wd-10p">Enployee No.</th>
														<th class="wd-25p">Name</th>
														<th class="wd-25p">Designation</th>
														<th class="wd-25p">Action</th>
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
															<td><?php echo $row['updated_at']; ?></td>
															<td><?php echo $row['letter_no']; ?></td>
															<td><?php echo $row['letter_date']; ?></td>
															<td><?php echo $row['emp_no']; ?></td>
															<td><?php echo $row['name']; ?></td>
															<td><?php echo $row['designation']; ?></td>
															<td>
																<a href="#" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target="#viewRequest" title="View">
																	<i class="fa fa-eye" aria-hidden="true"></i>
																</a>

																<a href="#" class="btn btn-sm btn-success" title="Download">
																	<i class="fa fa-download" aria-hidden="true"></i>
																</a>
															</td>
														</tr>

													<?php 
                                                
                                                            }
                                                        }
                                                    
                                                    ?>
												</tbody>
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
						<div class="modal-header pd-x-20">
							<h6 class="modal-title">Approval Date = <?php echo $row['updated_at']; ?></h6>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body pd-20">
							<div class="table-responsive">
								<table class="table table-bordered border-top mb-0">
									<tbody>
										<tr>
											<th>Status</th>
											<td class="text-success">
												<i class="fa fa-check" aria-hidden="true"></i>
												<?php echo $row['status']; ?>
											</td>
										</tr>

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
		<!-- ================================ MODAL ======================== -->

<?php include('../include/footer.php'); ?>  