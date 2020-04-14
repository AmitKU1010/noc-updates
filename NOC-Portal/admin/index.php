<?php 

    $page = 'index.php';
    $title = 'NOC Portal | Powered by MIXblack';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Session File
	include_once('../resource/session.php');
	
	// Include Database Conncection Script File
	include_once('../resource/database.php');

	// Include Utilities File
	include_once('../resource/utilities.php');

	include('session-restrict-admin.php');

	 
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
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>

						<div class="row row-cards">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center feature">
										<div class="fa-stack fa-lg icons shadow-default bg-warning-transparent">
											<i class="icon icon-rocket text-warning"></i>
										</div>
										<p class="card-text mt-3 mb-3">Live Requests</p>
										<p class="h2 text-center text-secondary-1">5,459</p>
									</div>
								</div>
							</div><!-- COL END -->

							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center feature">
										<div class="fa-stack fa-lg fa-1x icons shadow-default bg-primary-transparent">
											<i class="icon icon-people text-primary"></i>
										</div>
										
										<p class="card-text mt-3 mb-3">Total Requests</p>
										<p class="h2 text-center text-primary">3,456</p>
									</div>
								</div>
							</div><!-- COL END -->

							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center feature">
										<div class="fa-stack fa-lg fa-1x icons shadow-default bg-secondary-transparent">
											<i class="icon icon-refresh text-secondary"></i>
										</div>
										<p class="card-text mt-3 mb-3">Total Accepted Requests</p>
										<p class="h2 text-center text-secondary">2,635</p>
									</div>
								</div>
							</div><!-- COL END -->

							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
								<div class="card">
									<div class="card-body text-center feature ">
										<div class="fa-stack fa-lg fa-1x icons shadow-default bg-info-transparent">
											<i class="icon icon-speech text-info"></i>
										</div>
										<p class="card-text mt-3 mb-3">Total Airports</p>
										<p class="h2 text-center text-success-1">245</p>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
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