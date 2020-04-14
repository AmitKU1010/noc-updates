<?php 

    $page = 'hod.php';
    $title = 'HOD | NOC Portal';
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
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">HOD</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">HOD</li>
							</ol>
						</div>

                        <!-- START CONTENT -->
                        <div class="row row-deck">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mix-box">
                                                
                                            <form action="companies.php" method="post">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Airport Name</label>
                                                    <input type="text" name="name" class="form-control" value="" placeholder="Enter Airport Name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="name">Region</label>
                                                    <select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" name="region">
                                                        <option value="">Search</option>
                                                        <option value="Northern Region">Northern Region</option>
                                                        <option value="Eastern Region">Eastern Region</option>
                                                        <option value="North East Region">North East Region</option>
                                                        <option value="Western Region">Western Region</option>
                                                        <option value="Southern Region">Southern Region</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-block mt-4" name="company_add_btn" type="submit">
                                                        ADD AIRPORT
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">All Registered Airports</div>
                                    </div>

                                    <div class="card-body">           

                                        <div class="table-responsive">
                                            <table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Airports Name</th>
                                                        <th>Region</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr class="text-center">
                                                        <th scope="row"></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="companies.php" title="edit" class="btn btn-primary btn-sm">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="companies.php" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Airports Name</th>
                                                        <th>Region</th>
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

<?php include('../include/footer.php'); ?> 