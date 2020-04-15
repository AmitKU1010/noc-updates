<?php

	// Include Session File
	include_once('../resource/session.php');
	
    // Include Database Conncection Script File
	include_once('../resource/database.php');

	// Include Utilities File
	include_once('../resource/utilities.php');

	// Include Send Email File
	include_once('../resource/send-email.php');

	$r = $_SESSION['id'];
	// Initialize Variables
	$purpose = "";
	$letter_no = "";
    $letter_date = "";
    $due_date = "";
    $emp_no = "";
    $name = "";
    $designation = "";
    $department = "";
    $email = "";
    $phone = "";
    $rep_name = "";
    $rep_designation = "";
    $rep_email = "";
    $rep_phone = "";
	$id = 0;
	$update = false;

    /* ============================================================================== */
        // Add Employee Data
        if (isset($_POST['submit_request_btn'], $_POST['token'])) {

            // Validate the token
		    if(validate_token($_POST['token'])) {

                /** 
                 *  Process the form
                */

                // Initialize an array to store any error message form the form
                $form_errors = array();

                // Form validation
                $required_fields = array('purpose', 'letter_no', 'letter_date', 'due_date', 'emp_no', 'name', 'designation', 'department', 'email', 'phone', 'rep_name', 'rep_designation', 'rep_email', 'rep_phone', 'terms_condition');

                // Call the function to check empty field and merge the return data into form_error array
                $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

                // Email validation / merge the return data into form_error array
                $form_errors = array_merge($form_errors, check_email($_POST));

                
                // Collect form data and store in variables
                $purpose = $_POST['purpose'];
                $letter_no = $_POST['letter_no'];
                $letter_date = $_POST['letter_date'];
                $due_date = $_POST['due_date'];
                $emp_no = $_POST['emp_no'];
                $name = $_POST['name'];
                $designation = $_POST['designation'];
                $department = $_POST['department'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $rep_name = $_POST['rep_name'];
                $rep_designation = $_POST['rep_designation'];
                $rep_email = $_POST['rep_email'];
                $rep_phone = $_POST['rep_phone'];
                $type = 'Active';
                $user_id = $r;
                $msg = '';

                if (checkDuplicateRequest($user_id, $type, $db)) {

                    $msg = "<script>
                            swal({
                            title: \"Pending Requests Found\",
                            text: \".Use Modify/Cancel Request Form\",
                            type: 'error',
                            confirmButtonText: \"Ok\" });
                        </script>";
                        
                }

                // Check if error array is empty, if yes process form data and insert record
                else if (empty($form_errors)) {

                    // Secured user password
                    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    try {

                        // Create SQL Insert Statement
                        $sql = "INSERT INTO request (purpose, letter_no, letter_date, due_date, emp_no, name, designation, department, email, phone, rep_name, rep_designation, rep_email, rep_phone, user_id, type) VALUES (:purpose, :letter_no, :letter_date, :due_date, :emp_no, :name, :designation, :department, :email, :phone, :rep_name, :rep_designation, :rep_email, :rep_phone, :user_id, :type)";
            
                        // Use PDO Prepared to sanitize data
                        $stmt = $db->prepare($sql);
            
                        // Add the data into the database
                        $stmt->execute(array(':purpose' => $purpose, ':letter_no' => $letter_no, ':letter_date' => $letter_date, ':due_date' => $due_date, ':emp_no' => $emp_no, ':name' => $name, ':designation' => $designation, ':department' => $department, ':email' => $email, ':phone' => $phone, ':rep_name' => $rep_name, ':rep_designation' => $rep_designation, ':rep_email' => $rep_email, ':rep_phone' => $rep_phone, ':user_id' => $user_id, ':type' => $type));
            
                        // Check if one new row was created
                        if ($stmt->rowCount() == 1) {

                           $rq_id=$db->lastInsertId();

                            // Get all hod's Id
                            $ids_array = array();
                            $query = "SELECT * FROM users WHERE role = :role";
                            $stmt2 = $db->prepare($query);
                            $stmt2->execute(array(":role" => '1'));

                            while ($row = $stmt2->fetch()) {

                                $ids_array[] = $row['id'];

                            }

                            // exit();

                            $hod_id = count($ids_array);

                            // Get the last inserted ID
                            $user_id = $r;

                            $query2 = "INSERT INTO tracker (hod_id, status, req_id) VALUES (:hod_id, :status, :req_id)";
                            // Use PDO Prepared to sanitize data
                            $stmt3 = $db->prepare($query2);

                            for ($i=0; $i < $hod_id; $i++) { 
                                $total_price =$ids_array[$i];
                                $stmt3->execute(array(
                                    ':hod_id' => $total_price,
                                    ':status'   => 'Pending',
                                    ':req_id'   => $rq_id
                                ));

                            }

                            // Encode the ID
                            // $encode_id = base64_encode("encodeuserid{$user_id}");

                            // Prepare email body
                            $mail_body = '<html>
                                            <body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
                                                <div style="text-align:center;">
                                                    <h1 style="font-size:2rem; margin-bottom:30px;">Welcome '.$rep_name.'!</h1>

                                                    <p style="font-size:1rem;">Your New Account created successfully in NOC Portal. To login click below button</p>

                                                    <center>
                                                        <div style="width:200px; padding:10px; background-color:#00b7eb; color:#fff; margin-top:40px; margin-bottom:40px;">
                                                            <a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/AAI%20Projects/Final%20Projects/NOC%20Portal/login.php">Check Status</a>
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

                            $mail->addAddress($rep_email, $rep_name);
                            $mail->Subject = " Message from NOC Portal. ";
                            $mail->Body = $mail_body;
                            
                            //Error Handling for PHPMailer
                            if (!$mail->Send()){

                                $msg = flashMessage("Email sending failed: $mail->ErrorInfo ");
                            } else{

                                $msg = "<script>
                                            swal({
                                            title: \"Request Created Successfully!\",
                                            text: \"$name, Your Clearance Certificate Request Created.\",
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'pending-request.php';
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
        // Edit Create Request Data
        if (isset($_GET['edit'])) {

            $id = $_GET['edit'];
            $update = true;
            
            // Create SQL Insert Statement
            $sql = "SELECT * FROM request WHERE req_id = $id";
                                
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if (!empty($result)) {

                foreach($result as $row) {
                    $purpose = $row['purpose'];
                    $letter_no = $row['letter_no'];
                    $letter_date = $row['letter_date'];
                    $due_date = $row['due_date'];
                    $emp_no = $row['emp_no'];
                    $name = $row['name'];
                    $designation = $row['designation'];
                    $department = $row['department'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $rep_name = $row['rep_name'];
                    $rep_designation = $row['rep_designation'];
                    $rep_email = $row['rep_email'];
                    $rep_phone = $row['rep_phone'];
                }

            }

        }

    /* ============================================================================== */
        // Update Create Request Data
        if (isset($_POST['update_submit_request_btn'])) {

            $id = $_POST['id'];
            $purpose = $_POST['purpose'];
            $letter_no = $_POST['letter_no'];
            $letter_date = $_POST['letter_date'];
            $due_date = $_POST['due_date'];
            $emp_no = $_POST['emp_no'];
            $name = $_POST['name'];
            $designation = $_POST['designation'];
            $department = $_POST['department'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $rep_name = $_POST['rep_name'];
            $rep_designation = $_POST['rep_designation'];
            $rep_email = $_POST['rep_email'];
            $rep_phone = $_POST['rep_phone'];

            // Create SQL Insert Statement
            $sql = "UPDATE request SET purpose = '$purpose', letter_no = '$letter_no', letter_date = '$letter_date', due_date = '$due_date', emp_no = '$emp_no', name = '$name', designation = '$designation', department = '$department', email = '$email', phone = '$phone', rep_name = '$rep_name', rep_designation = '$rep_designation', rep_email = '$rep_email', rep_phone = '$rep_phone' WHERE req_id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            header('location: pending-request.php');

        }
    
    /* ============================================================================== */
        // Delete Create Request Data
        if (isset($_GET['del'])) {

            $id = $_GET['del'];
            // Delete data from request table
            $sql = "DELETE FROM request WHERE req_id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            // DELETE Data from Tracker Table
            $sql2 = "DELETE FROM tracker WHERE req_id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt2 = $db->prepare($sql2);

            // Add the data into the database
            $stmt2->execute();

            header('location: pending-request.php');

        }

    /* ============================================================================== */
        // HOD Update Re-check Data
        if (isset($_POST['submit_recheck_btn'])) {

            $id = $r;
            $comments = $_POST['comments'];

            // Create SQL Update Statement
            $sql = "UPDATE tracker SET status = 'Recheck', recheck = '1', comments = '$comments' WHERE hod_id = $id";
        
            // Use PDO Prepared to sanitize data
               $stmt = $db->prepare($sql);

               // Add the data into the database
               $stmt->execute();

               header('location: recheck-request.php');

        }
    
    /* ============================================================================== */
        // HOD Delete Request Data
        if (isset($_GET['delete'])) {

            $id = $_GET['delete'];
            // Delete data from request table
            $sql = "DELETE FROM tracker WHERE hod_id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            header('location: pending-request.php');

        }


    /* ============================================================================== */
        // HOD Approve Request Data
        if (isset($_GET['approve'])) {

            $id = $_GET['approve'];
            // Delete data from request table
            $sql = "UPDATE tracker SET status = 'Approved', recheck = '0' WHERE hod_id = $id";
            
            // Use PDO Prepared to sanitize data
            $stmt = $db->prepare($sql);

            // Add the data into the database
            $stmt->execute();

            header('location: approved-request.php');

        }

    /* ============================================================================== */
        // Employee Update Re-check Data
        if (isset($_POST['submit_resubmit_btn'])) {

            $id = $_GET['id'];
            $document = $_POST['document'];
            $discription = $_POST['discription'];

            // Create SQL Update Statement
            $sql = "UPDATE tracker SET status = 'Pending', recheck = '0', document = '$document', emp_comts = '$discription' WHERE tr_id = $id";
        
            // Use PDO Prepared to sanitize data
               $stmt = $db->prepare($sql);

               // Add the data into the database
               $stmt->execute();

               header('location: recheck-request.php');

        }


?>