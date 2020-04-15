<?php 

    $page = 'recheck-request.php';
    $title = 'Re-check Request | NOC Portal';
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
                            <h4 class="page-title">Re-check Request</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Re-check Request</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row mt-4">

							<!-- Pending Request -->
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto">
                                <div class="card">
									<div class="card-header">
										<h5>All Re-check Request</h5>
									</div>
                                    <div class="card-body">
										<?php 

											$user_id = $_SESSION['id'];
											$rq_id = '';
											$let_no = '';
											$let_date = '';
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
													$letter_no = $row['letter_no'];
													$letter_date = $row['letter_date'];
												}
											}

											$rq_id = $req_id;
											$let_no = $letter_no;
											$let_date = $letter_date;

											$query = "SELECT * FROM tracker INNER JOIN users on tracker.hod_id = users.id WHERE tracker.req_id = '$rq_id' AND tracker.status = 'Recheck' AND tracker.recheck = '1'";

											$stmt2 = $db->prepare($query);

											$stmt2->execute();

											$result2 = $stmt2->fetchAll();

										?>  

										<div class="table-responsive">
											<table id="example" class="table table-striped table-bordered" >
												<thead>
													<tr>
														<th>#</th>
														<th>Letter No.</th>
														<th >Letter date</th>
														<th >HOD Name</th>
														<th >Department</th>
														<th >Comments</th>
														<th class="wd-50p">Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
                                                        
                                                        $i = 1;

                                                        if (!empty($result2)) {

                                                            foreach($result2 as $row) {
                                                    ?>

														<tr class="text-center">
															<th scope="row"><?php echo $i++; ?></th>
															<td><?php echo $let_no; ?></td>
															<td><?php echo $let_date; ?></td>
															<td><?php echo $row['name']; ?></td>
															<td><?php echo $row['department']; ?></td>
															<td><?php echo $row['comments']; ?></td>
															<td>
																<a href="submit-recheck.php?id=<?php echo $row['tr_id']; ?>" class="btn btn-primary mb-2">
																	<i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp; 
																	Submit
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

<?php include('../include/footer.php'); ?> 