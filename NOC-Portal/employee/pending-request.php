<?php 

    $page = 'pending-request.php';
    $title = 'Pending Request | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Login Parse File
    include('../partials/parseCreateRequest.php'); 

	// Include ParseProfle page
	include_once('../partials/parseProfile.php');

	// redirect user to login page if they're not logged in
	if (empty($_SESSION['id'] || isCookieValid($db))) {
		if($_SESSION['role'] === '0'){
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
							<div class="col-lg-7 col-xl-8 mx-auto">
                                <div class="card">
									<div class="card-header">
										<h5>Pending Request</h5>
									</div>

                                    <div class="card-body">
										<?php 

											$user_id = $_SESSION['id'];

											// Create SQL Insert Statement
											$sql = "SELECT * FROM request WHERE user_id = '$user_id' AND type = 'Active'";

											// Use PDO Prepared to sanitize data
											$stmt = $db->prepare($sql);

											$stmt->execute();

											$result = $stmt->fetchAll();

										?>  

										<div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-bordered border-top mb-0">
                                                    <tbody>
                                                        <?php 
        
                                                            if (!empty($result)) {

                                                                foreach($result as $row) {
                                                        ?>

                                                            <tr>
                                                                <th>Purpose</th>
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

															<tr>
																<button class="btn btn-primary mb-2 mr-2" title="track" data-toggle="modal" data-target="#largeModal">
																	<i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp; Track
																</button>

																<a href="create-request.php?edit=<?php echo $row['req_id']; ?>" title="edit" class="btn btn-danger mb-2 mr-2">
																	<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit
																</a>

																<a href="pending-request.php?del=<?php echo $row['req_id']; ?>" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-light text-danger mb-2 mr-2">
																	Delete
																</a>
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

                                    <div class="card-footer text-right">
										
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
			<!-- Track Modal -->
			<div id="largeModal" class="modal fade">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content ">
						<div class="modal-header pd-x-20">
							<h6 class="modal-title">Live Update</h6>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body pd-20">
							<?php 

								$user_id = $_SESSION['id'];
								$rq_id = '';
								$req_id = '';

								// Create SQL Insert Statement
								$sql = "SELECT * FROM request WHERE user_id = '$user_id' AND type = 'Active' LIMIT 1";

								// Use PDO Prepared to sanitize data
								$stmt = $db->prepare($sql);

								$stmt->execute();

								$result = $stmt->fetchAll();

								if (!empty($result)) {

									foreach($result as $row) {

										$req_id = $row['req_id'];	
									}
								}

								$rq_id = $req_id;

								$query = "SELECT * FROM tracker INNER JOIN users on tracker.hod_id = users.id WHERE tracker.req_id = '$rq_id'";

								$stmt2 = $db->prepare($query);

								$stmt2->execute();

								$result2 = $stmt2->fetchAll();

							?>  

							<div class="table-responsive">
								<table class="table table-bordered border-top mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>HOD</th>
											<th>Deptt./Section</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php 

											$i = 1;

											if (!empty($result2)) {

												foreach($result2 as $row) {
										?>

											<tr>
												<th scope="row"><?php echo $i++; ?></th>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['department']; ?></td>
												<?php if($row['status'] == 'Pending') { ?>

													<td class="text-primary"><?php echo $row['status']; ?></td>

												<?php } else if($row['status'] == 'Recheck') {?>

													<td class="text-warning"><?php echo $row['status']; ?></td>

												<?php } else if($row['status'] == 'Approved') {?>

													<td class="text-success"><?php echo $row['status']; ?></td>

												<?php } ?>
												
												<?php if($row['status'] == 'Pending') { ?>
													<td>
														<a href="#" class="btn btn-warning mr-3"> 
															<i class="fa fa-bell" aria-hidden="true"></i>
															Reminder
														</a>
													</td>
												<?php } ?>
											</tr>

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
				</div><!-- modal-dialog -->
			</div><!-- modal -->
		<!-- ================================ MODAL ======================== -->

<?php include('../include/footer.php'); ?> 