<?php 

    $page = 'approved-request.php';
    $title = 'Approved Request | NOC Portal';
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
                            <h4 class="page-title">Approved Request</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Approved Request</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row row-cards">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-5">
								<div class="card">
									<div class="card-header">
										<p class="mt-3">Current Approved</p>
									</div>

									<?php 

										$user_id = $_SESSION['id'];

										// Create SQL Insert Statement
										$sql = "SELECT * FROM request WHERE user_id = '$user_id' AND type = 'Approved'";

										// Use PDO Prepared to sanitize data
										$stmt = $db->prepare($sql);

										$stmt->execute();

										$result = $stmt->fetchAll();

									?>  

									<div class="card-body">
										<?php 
                                                        
											$i = 1;

											if (!empty($result)) {

												foreach($result as $row) {
										?>

											<div class="card overflow-hidden">
												<div class="power-ribbon power-ribbon-top-left text-primary">
													<span class="bg-primary">
														<i class="fa fa-certificate"></i>
													</span>
												</div>

												<?php
											   $approve_dt= $row['letter_date'];
											   $date1=date_create($approve_dt);
											   $date2=date_create(date('Y/m/d'));

											  
											   $diff=date_diff($date1,$date2);
											   $rr=$diff->days;
 
											   
											//    print_r($date1);
											//    print_r($date2);



											//    var_dump($rr);

											   $diff=date_diff($date1,$date2);
											   if($rr<=5)
											   {
                                                ?>
												
												<div class="card-body">
													<div class="item-det row">
														<div class="col-md-12">
															<h4 class="mb-2 text-dark">
																Letter No.: <?php echo $row['letter_no']; ?> | Date: <?php echo $row['letter_date']; ?>
															</h4>
															
															<div class="">
																<ul class="mb-0 d-flex">
																	<li class="mr-5">
																		<a href="#" class="icons">
																			<i class="icon icon-tag text-muted mr-1"></i> 
																			Employee No. = <?php echo $row['emp_no']; ?>
																		</a>
																	</li>
																	
																	<li class="mr-5">
																		<a href="#" class="icons">
																			<i class="icon icon-user text-muted mr-1"></i> 
																			<?php echo $row['name']; ?>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
			
														<div class="col-md-12">
															<div class="row mt-4">
																<div class="col-md-7"></div>
			
																<div class="col-md-5">
																	<a href="download-pdf.php?id=<?php echo $row['req_id']; ?>" class="btn btn-success mr-3">
																		<i class="fa fa-download" aria-hidden="true"></i> &nbsp;
																		Download
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>

											<?php 
											} 
											else
											{
											?>
											
                                           <h3 style="padding-left:90px;">Sorry No Approved Request Found!!!!</h3>
										   <?php
											}
											?>
											</div>

										<?php 
                                                
												}
											}
										
										?>
									</div>
								</div>
							</div><!-- COL END -->

							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-7">
								<div class="card">
									<div class="card-header">
										<p class="mt-3">All Approved Requests</p>
									</div>

									<div class="card-body text-center feature">
										<?php 

											$user_id = $_SESSION['id'];

											// Create SQL Insert Statement
											$sql = "SELECT * FROM request WHERE user_id = '$user_id' AND type = 'Approved'";

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
														<th class="wd-15p">Request No.</th>
														<th class="wd-20p">Letter No.</th>
														<th class="wd-15p">Date</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
	
														if (!empty($result)) {
	
															foreach($result as $row) {
													?>

														<tr>
															<th scope="row"><?php echo $i++; ?></th>
															<td><?php echo $row['req_id']; ?></td>
															<td><?php echo $row['letter_no']; ?></td>
															<td><?php echo $row['letter_date']; ?></td>
															<td>
																<a href="view-record.php?id=<?php echo $row['req_id']; ?>" class="btn btn-primary btn-sm mr-2" title="View">
																	<i class="fa fa-eye" aria-hidden="true"></i>
																</a>

																<a href="download-pdf.php?id=<?php echo $row['req_id']; ?>" class="btn btn-success btn-sm" title="Download">
																	<i class="fa fa-download"  target="_blank" aria-hidden="true"></i>
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
							</div><!-- COL END -->
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