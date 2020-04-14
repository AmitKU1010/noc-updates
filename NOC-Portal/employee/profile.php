<?php 

    $page = 'profile.php';
    $title = 'Profile | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
	$keywords = '';

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

	<!-- START PAGE -->
	<div class="page">

		<div class="page-main">
			<!-- Include Sidebar -->
			<?php include('sidebar.php'); ?>

			<div class="app-content  my-4 my-md-6">
				<div class="side-app">
					<div class="page-header">
						<h4 class="page-title">My Profile</h4>
						
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo $url; ?>">Dashboard</a>
							</li>
							
							<li class="breadcrumb-item active" aria-current="page">Profile</li>
						</ol>
					</div>

					<!-- START CONTENT -->
					<div class="row">
                        <div class="col-lg-5 col-xl-4">
                            <div class="card card-profile cover-image "  data-image-src="<?php echo $url; ?>assets/images/other/profile-bg.jpg">
                                <div class="card-body text-center">
									<div>
										<img src="<?php if(isset($profile_picture)) echo $profile_picture; ?>" alt="user_profile" class="card-profile-img">
										<a href="edit-profile.php" class="mix-edit-profile" title="Edit Profile">
											<span class="fa fa-pencil" aria-hidden="true"></span>
										</a>
									</div>

                                    <h3 class="mb-1 text-white">
                                        <?php if(isset($name)) echo $name; ?>
                                    </h3>
                                    
                                    <p class="mb-2 text-white">
                                        <?php if(isset($email)) echo $email; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Useful Links</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="edit-profile.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>" class="btn btn-warning btn-block mb-2">
												<i class="fa fa-pencil-square-o mr-1" aria-hidden="true"></i>
												Edit Profile
											</a>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="change-password.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>" class="btn btn-primary btn-block">
												<i class="fa fa-pencil mr-1" aria-hidden="true"></i>
												Change Password
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
						Copyright © <?php echo date("Y"); ?>
						<a href="<?php echo $url; ?>">IT Department, RHQ-ER, AAI</a>. 
						Powered by 
						<a href="https://www.mixblack.co.in/" target="_blank">MIXblack</a> 
						All rights reserved.
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer-->

	</div>
	<!-- END PAGE -->

<?php include('../include/footer.php'); ?>  