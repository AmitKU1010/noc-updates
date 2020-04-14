<?php 

    $page = 'index.php';
    $title = 'NOC Portal | Powered by MIXblack';
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
				<div class="app-content  my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Dashboard</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>

						 <!-- START CONTENT -->
						<div class="row row-cards">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
								<div class="card">
									<div class="card-body text-center feature">
									</div>
								</div>
							</div><!-- COL END -->

							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-8">
								<div class="card">
									<div class="card-body text-center feature">
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