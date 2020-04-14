<?php 

    $page = 'hod.php';
    $title = 'HOD | NOC Portal';
    $description = 'Clearance Certificate Portal - NOC App';
    $keywords = '';

	// Include Login Parse File
    include('../partials/parseHOD.php'); 

	include('session-restrict-admin.php');

    
    // redirect user to login page if they're not logged in
	// if (empty($_SESSION['id'] || isCookieValid($db))) {
	// 	if($_SESSION['role'] === '2'){
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
                                            <!-- Display Messages -->
                                            <div>									
                                                <?php if (isset($msg)) { echo $msg; } ?>

                                                <?php if (!empty($form_errors)) { echo show_errors($form_errors); } ?>
                                            </div>

                                            <div class="clearfix"></div>
                                                
                                            <form action="hod.php" method="post">
                                                <div class="form-group">
                                                    <label class="form-label text-dark">
                                                        HOD Name
                                                        <span class="text-danger">*</span> 
                                                    </label>

                                                    <input type="text" name="name" class="form-control" value="<?php if(isset($name)) echo $name; ?>" placeholder="Enter full name">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label text-dark">
                                                        Department
                                                        <span class="text-danger">*</span> 
                                                    </label>

                                                    <input type="text" name="department" class="form-control" value="<?php if(isset($department)) echo $department; ?>" placeholder="Enter Department">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label text-dark">
                                                        Email address
                                                        <span class="text-danger">*</span> 
                                                    </label>

                                                    <input type="text" name="email" class="form-control" value="<?php if(isset($email)) echo $email; ?>" placeholder="Enter Enail ID">
                                                </div>

                                                <?php if ($update == true): ?>
                                                
                                                <?php else: ?>
                                                    <div class="form-group">
                                                        <label class="form-label text-dark">
                                                            Password
                                                            <span class="text-danger">*</span>
                                                        </label>

                                                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                    </div>
                                                <?php endif ?>

                                                <!-- newly added field -->
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                                <input type="hidden" name="token" value="<?php if(function_exists('_token')) echo _token(); ?>">

                                                <div class="form-group">
                                                    <?php if ($update == true): ?>
                                                        <button class="btn btn-primary btn-block mt-4" name="hod_update_btn" type="submit">
                                                            UPDATE HOD
                                                        </button>
                                                    <?php else: ?>
                                                        <button class="btn btn-primary btn-block mt-4" name="hod_add_btn" type="submit">
                                                            ADD HOD
                                                        </button>
                                                    <?php endif ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">All Registered HOD</div>
                                    </div>

                                    <div class="card-body"> 

                                        <?php 

                                            // Create SQL Insert Statement
                                            $sql = "SELECT * FROM users WHERE role = '1' ORDER BY id DESC";

                                            // Use PDO Prepared to sanitize data
                                            $stmt = $db->prepare($sql);

                                            $stmt->execute();

                                            $result = $stmt->fetchAll();

                                        ?>            

                                        <div class="table-responsive">
                                            <table id="example2" class="hover table-bordered border-top-0 border-bottom-0" >
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Department</th>
                                                        <th>Email</th>
                                                        <th>Action</th>
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
                                                            <td><?php echo $row['name']; ?></td>
                                                            <td><?php echo $row['department']; ?></td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td>
                                                                <a href="hod.php?edit=<?php echo $row['id']; ?>" title="edit" class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                </a>

                                                                <a href="hod.php?del=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    <?php 
                                                
                                                            }
                                                        }
                                                    
                                                    ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Department</th>
                                                        <th>Email</th>
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