<?php 

	// Define Variables
    $page = 'index.php';
    $title = 'NOC Portal | Powerd by MIXblack';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

	// Include Signout Parse File
	include('partials/parseSignup.php'); 

	// Include Header File
	include('include/header.php'); 

	// redirect user to login page if they're not logged in
	// if (empty($_SESSION['id'] || isCookieValid($db))) {
	// 	header('location: mix-login.php');
	// }

	// guard();

?>

	<!-- START PAGE -->
	<div class="page">
        <!-- Header Menu -->
		<div class="app-header1 header py-1 d-flex">
			<div class="container-fluid">
				<div class="d-flex">
					<a class="header-brand" href="index.php">
						<img src="<?php echo $url; ?>assets/images/brand/aai.png" class="header-brand-img" alt="AAI">
					</a>

					<!-- <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a> -->

					<!-- <div class="header-navicon mt-2">
						<a href="create-request.html" class="btn btn-primary">
							<i class="fa fa-plus"></i> Create Request
						</a>
					</div> -->

					<div class="d-flex order-lg-2 ml-auto">

						<?php 
							
							if (empty($_SESSION['id'] || isCookieValid($db))) {

						?>
							<!-- Request Create Button -->
							<div class="dropdown d-none d-md-flex country-selector">
								<a href="#" class="d-flex nav-link leading-none">
									<div>
										<a href="<?php echo $url; ?>login.php" class="btn btn-primary">
											Log In
										</a>

										<a href="registration.php" class="ml-4">
											Employee Registration
										</a>
									</div>
								</a>
							</div>
						
						<?php } else { ?>

							<!-- Profile Action -->
							<div class="dropdown ">
								<a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
									<img src="<?php echo $url; ?>assets/images/faces/default-user.png" alt="profile-img" class="avatar avatar-md brround">
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
									<?php if($_SESSION['role'] === '0') { ?>
									
										<a class="dropdown-item" href="<?php echo $url; ?>employee/index.php">
											<i class="dropdown-icon  icon icon-grid"></i> Dashboard
										</a>

									<?php } else if ($_SESSION['role'] === '1') { ?>

										<a class="dropdown-item" href="<?php echo $url; ?>hod/index.php">
											<i class="dropdown-icon  icon icon-grid"></i> Dashboard
										</a>

									<?php } else if ($_SESSION['role'] === '2') { ?>

										<a class="dropdown-item" href="<?php echo $url; ?>admin/index.php">
											<i class="dropdown-icon  icon icon-grid"></i> Dashboard
										</a>

									<?php } ?>

									<a class="dropdown-item" href="<?php echo $url; ?>logout.php">
										<i class="dropdown-icon icon icon-power"></i> Log out
									</a>
								</div>
							</div>

						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="page-main mt-4">
            <!--section-->
            <section class="sptb bg-white">
                <div class="container">
                    <div class="text-center mt-10">
                        <?php if(isset($result)) echo $result; ?>
                    </div>
                </div>
            </section>
            <!--/section-->
		</div>

		<!--footer-->
		<footer class="footer">
			<div class="container">
				<div class="row align-items-center flex-row-reverse">
					<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
						Copyright © <?php echo date("Y"); ?>
						<a href="<?php echo $url; ?>">NOC Portal</a> |
						Powered by 
						<a href="https://www.mixblack.co.in/" target="_blank">MIXblack</a> |
						All rights reserved.
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer-->

	</div>
	<!-- END PAGE -->

<?php include('include/footer.php'); ?>  