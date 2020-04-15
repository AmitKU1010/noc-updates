<?php 
 
    $page = 'view-record.php';
    $title = 'View Record | NOC Portal';
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
                            <h4 class="page-title">View Record</h4>
                            
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Dashboard</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">View Record</li>
                            </ol>
                        </div>
    
                        <!-- START CONTENT -->
                        <div class="row mt-4">
							<div class="col-lg-7 col-xl-8 mx-auto">
								<div class="card">
									<div class="card-header">
										<a href="approved-request.php" class="btn btn-outline-primary"><< Back</a>
									</div>

                                    <div class="card-body">

                                        <div class="row">
                                            <?php 

                                                $id = $_GET['id'];

                                                // Create SQL Insert Statement
                                                $sql = "SELECT * FROM request WHERE req_id = '$id' AND type = 'Approved'";

                                                // Use PDO Prepared to sanitize data
                                                $stmt = $db->prepare($sql);

                                                $stmt->execute();

                                                $result = $stmt->fetchAll();

                                            ?>  

                                            <div class="table-responsive">
                                                <table class="table table-bordered border-top mb-0">
                                                    <tbody>
                                                        <?php 
        
                                                            if (!empty($result)) {

                                                                foreach($result as $row) {
                                                        ?>

                                                            <tr>
                                                                <th>Status</th>
                                                                <td class="text-success">
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                    <?php echo $row['type']; ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Approved Date</th>
                                                                <td><?php echo $row['updated_at']; ?></td>
                                                            </tr>

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
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <a href="#" class="btn btn-success" title="Download">
                                                    <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download
                                                </a>
                                            </div>
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