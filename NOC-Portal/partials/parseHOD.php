<?php

	// Include Session File
	include_once('../resource/session.php');
	
    // Include Database Conncection Script File
	include_once('../resource/database.php');

	// Include Utilities File
	include_once('../resource/utilities.php');

	// Include Send Email File
	include_once('../resource/send-email.php');

	
	// Initialize Variables
	$department = "";
	$email = "";
    $password = "";
	$id = 0;
	$update = false;

    /* ============================================================================== */
        // Add Employee Data
        if (isset($_POST['hod_add_btn'], $_POST['token'])) {

            // Validate the token
		    if(validate_token($_POST['token'])) {

                /** 
                 *  Process the form
                */

                // Initialize an array to store any error message form the form
                $form_errors = array();

                // Form validation
                $required_fields = array('name', 'department', 'email', 'password');

                // Call the function to check empty field and merge the return data into form_error array
                $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

                // Fields that requires checking for minimum length
                $fields_to_check_length = array('password' => 6);

                // Call the function to check minimum required length and merge the return data into form_error array
                $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

                // Email validation / merge the return data into form_error array
                $form_errors = array_merge($form_errors, check_email($_POST));

                
                // Collect form data and store in variables
                $name = $_POST['name'];
                $department = $_POST['department'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $role = '1';
                $activated = '1';
                $msg = '';

                if (checkDuplicateEmail($email, $db)) {

                    $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"Email ID is already taken, Please try another one\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";
                        
                }

                // Check if error array is empty, if yes process form data and insert record
                else if (empty($form_errors)) {

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Secured user password
                    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    try {

                        // Create SQL Insert Statement
                        $sql = "INSERT INTO users (name, department, password, email, role, activated, join_date) VALUES (:name, :department, :password, :email, :role, :activated, now())";
            
                        // Use PDO Prepared to sanitize data
                        $stmt = $db->prepare($sql);
            
                        // Add the data into the database
                        $stmt->execute(array(':name' => $name, ':department' => $department, ':password' => $hashed_password, ':email' => $email, ':role' => $role, ':activated' => $activated));
            
                        // Check if one new row was created
                        if ($stmt->rowCount() == 1) {

                            // Get the last inserted ID
                            // $user_id = $db->lastInsertId();

                            // Encode the ID
                            // $encode_id = base64_encode("encodeuserid{$user_id}");

                            // Prepare email body
                            $mail_body = '<html>
                                            <body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
                                                <div style="text-align:center;">
                                                    <h1 style="font-size:2rem; margin-bottom:30px;">Welcome '.$name.'!</h1>

                                                    <p style="font-size:1rem;">Your New Account created successfully in NOC Portal. To login click below button</p>

                                                    <p style="font-size:1rem;">your login email = "'.$email.'" & Password = "'.$password.'"</p>

                                                    <center>
                                                        <div style="width:200px; padding:10px; background-color:#00b7eb; color:#fff; margin-top:40px; margin-bottom:40px;">
                                                            <a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/AAI%20Projects/Final%20Projects/NOC%20Portal/login.php">Log In</a>
                                                        </div>
                                                    </center>

                                                    <p style="margin-bottom:40px; font-size:1rem;">
                                                        if you have any questions, just replay to this email - we\'re always happy to help out.
                                                    </p>

                                                    <p style="margin-bottom:40px">
                                                        <strong>NOC Portal | IT Department Team, RHQ-ER, AAI</strong>
                                                    </p>

                                                    <p>
                                                        <small>Copyright © ' .date('Y'). ' <strong>NOC Portal</strong> | 
                                                        Powered by <strong>MIXblack</strong>  |
                                                        All rights reserved.</small>
                                                    </p>
                                                </div>
                                            </body>
                                        </html>';

                            $mail->addAddress($email, $name);
                            $mail->Subject = " Message from NOC Portal ";
                            $mail->Body = $mail_body;
                            
                            //Error Handling for PHPMailer
                            if (!$mail->Send()){

                                $msg = flashMessage("Email sending failed: $mail->ErrorInfo ");
                            } else{

                                $msg = "<script>
                                            swal({
                                            title: \"Account Created Successfully!\",
                                            text: \"$name, New HOD Created.\",
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'hod.php';
                                            }, 2000);
                                        </script>";
                            }

                            // $msg = flashMessage("Registration Successful");

                            // redirectTo('mix-login');

                        }
            
                    } catch (PDOException $ex) {
            
                        $msg = flashMessage("An error occurred: " . $ex->getMessage());
            
                    }


                } else {

                    if (count($form_errors) == 1) {

                        $msg = flashMessage("There was 1 error in the form <br>");

                    } else {

                        $msg = flashMessage("There were " . count($form_errors) . " errors in the form <br>");

                    }

                }
        
            } else {

                // Throw an error
                $msg = "<script>
                            swal({
                            title: \"Oops..\",
                            text: \"This request originates from an unknown source, posible attack\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";

            }
    
    
        }

    /* ============================================================================== */ 
        // Edit Signatory Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM users WHERE id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {
                    $name = $row['name'];
                    $department = $row['department'];
                    $email = $row['email'];
                }

            }

        }

    /* ============================================================================== */
        // Update Signatory Data
        if (isset($_POST['hod_update_btn'])) {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $department = $_POST['department'];
            $email = $_POST['email'];

            // Create SQL Insert Statement
            $sql = "UPDATE users SET name = '$name', department = '$department', email = '$email' WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            header('location:hod.php');

        }
    
    /* ============================================================================== */
        // Delete Signatory Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Create SQL Insert Statement
            $sql = "DELETE FROM users WHERE id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            header('location:hod.php');

        }


?>