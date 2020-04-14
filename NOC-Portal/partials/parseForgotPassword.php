<?php 

    // Include Session File
	include_once('resource/session.php');

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
	include_once('resource/utilities.php');

	// Include Send Email File
	include_once('resource/send-email.php');

    //process the form if the Reset Password button is clicked
    if(isset($_POST['reset_password_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */

            //initialize an array to store any error message from the form
            $form_errors = array();

            //Form validation
            $required_fields = array('email', 'reset_token', 'new_password', 'confirm_password');

            //call the function to check empty field and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            //Fields that requires checking for minimum length
            $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

            //call the function to check minimum required length and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

            //check if error array is empty, if yes process form data
            if(empty($form_errors)) {

                //collect form data and store in variables
                $email = $_POST['email'];
                $reset_token = $_POST['reset_token'];
                $password1 = $_POST['new_password'];
                $password2 = $_POST['confirm_password'];

                //check if new password and confirm password is same
                if($password1 != $password2) {

                    $msg = "<script>
                                swal({
                                title: \"Oops..\",
                                text: \"Password does not matched\",
                                type: 'error',
                                confirmButtonText: \"Try again\" });
                            </script>"; 

                } else {

                    try {

                        // Validate email and token
                        $validateSql = "SELECT * FROM password_resets WHERE email = :email";
                        $validateStmt = $db->prepare($validateSql);
                        $validateStmt->execute([
                            ':email' => $email
                        ]);

                        $isValid = true;

                        if($rows = $validateStmt->fetch()) {

                            // Email found
                            $stored_token = $rows['token'];
                            $expire_time = $rows['expire_time'];

                            // Check token
                            if($stored_token !== $reset_token) {

                                $isValid = false;

                                $msg = "<script>
                                        swal({
                                        title: \"Oops..\",
                                        text: \"You have entered an invalid token\",
                                        type: 'error',
                                        confirmButtonText: \"Try again\" });
                                    </script>";

                            }

                            // Check expire time
                            if($expire_time < date('Y-m-d H:i:s')) {

                                $isValid = false;

                                $msg = "<script>
                                        swal({
                                        title: \"Oops..\",
                                        text: \"This reset token has expired, request a new one\",
                                        type: 'error',
                                        confirmButtonText: \"Ok\" });
                                    </script>";
                                
                                    // Delete token
                                    $db->exec("DELETE FROM password_resets WHERE email = '$email' AND token = '$stored_token'");

                            }

                        } else {

                            $isValid = false;
                            goto invalid_email;

                        }

                        // If token verification pass
                        if($isValid) {

                            //create SQL select statement to verify if email address input exist in the database
                            $sqlQuery = "SELECT id FROM users WHERE email =:email";

                            //use PDO prepared to sanitize data
                            $statement = $db->prepare($sqlQuery);

                            //execute the query
                            $statement->execute(array(':email' => $email));

                            //check if record exist
                            if($rs = $statement->fetch()){
                                //hash the password
                                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                                $id = $rs['id'];

                                //SQL statement to update password
                                $sqlUpdate = "UPDATE users SET password =:password WHERE id=:id";

                                //use PDO prepared to sanitize SQL statement
                                $statement = $db->prepare($sqlUpdate);

                                //execute the statement
                                $statement->execute(array(':password' => $hashed_password, ':id' => $id));

                                if ($statement->rowCount() == 1) {

                                    // Delete token
                                    $db->exec("DELETE FROM password_resets WHERE email = '$email' AND token = '$stored_token'");

                                }

                                $msg = "<script>
                                            swal({
                                            title: \"Updated!\",
                                            text: \"Your Password Updated Successfully.\",
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'login.php';
                                            }, 2000);
                                        </script>";

                            } else {

                                invalid_email:
                                
                                $msg = "<script>
                                            swal({
                                            title: \"Oops..\",
                                            text: \"provided email id does not exist in our database, please try again\",
                                            type: 'error',
                                            confirmButtonText: \"Try again\" });
                                        </script>";

                            }

                        }

                    } catch (PDOException $ex){

                        $msg = flashMessage("An error occurred: " .$ex->getMessage());
                    }
                
                }

            } else {

                if(count($form_errors) == 1){

                    $mag = flashMessage("There was 1 error in the form<br>");

                } else {

                    $msg = flashMessage("There were " .count($form_errors). " errors in the form <br>");
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
    
    //process the form if the Forgot Password button is clicked
    else if (isset($_POST['forgot_password_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */

            // Initialize an array to store any error message from the form
            $form_errors = array();

            // Form Validation
            $required_fields = array('email');

            // Call the function to check empty field and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            // Email validation / merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_email($_POST));

            // Check if error array is empty, if yes process form data
            if (empty($form_errors)) {

                // Collect form data and store in variables
                $email = $_POST['email'];

                try {

                    // Create SQL select statement to verify if email address input exist in the database
                    $sql = "SELECT * FROM users WHERE email = :email";

                    // Use PDO prepared to sanitize data
                    $stmt = $db->prepare($sql);

                    // Execute the query
                    $stmt->execute(array(':email' => $email));

                    // Check if record exist
                    if($row = $stmt->fetch()) {

                        $name = $row['name'];
                        $email = $row['email'];
                        $user_id = $row['id'];

                        // Create and store token
                        $expire_time = date('Y-m-d H:i:s', strtotime('10 minutes'));
                        $random_string = base64_encode(openssl_random_pseudo_bytes(10));
                        $reset_token = strtoupper(preg_replace('/[^A-Za-z0-9\-]/', '', $random_string));

                        $insertToken = "INSERT INTO password_resets (email, token, expire_time) VALUES (:email, :token, :expire_time)";
                        $token_stmt = $db->prepare($insertToken);
                        $token_stmt->execute([
                            ':email' => $email,
                            ':token' => $reset_token,
                            ':expire_time' => $expire_time
                        ]);

                        // Prepare email body
                        $mail_body = '<html>
                                        <body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
                                            <div style="text-align:center;">
                                                <h1 style="font-size:2rem; margin-bottom:30px;">Hi '.$name.'!</h1>

                                                <p style="font-size:1rem;">To reset your login password, please click on the link below.</p>

                                                <p style="font-size:1rem;">Token: '. $reset_token .' <br> This token will expire after 10 minutes.</p>

                                                <center>
                                                    <div style="width:200px; padding:10px; background-color:#00b7eb; color:#fff; margin-top:40px; margin-bottom:40px;">
                                                        <a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/AAI%20Projects/Final%20Projects/NOC%20Portal/reset-password.php">Reset Password</a>
                                                    </div>
                                                </center>

                                                <p style="margin-bottom:40px; font-size:1rem;">
                                                    if you have any questions, just replay to this email - we\'re always happy to help out.
                                                </p>

                                                <p style="margin-bottom:40px">
													<strong>NOC Portal | IT Department Team, RHQ-ER, AAI</strong>
												</p>

                                                <p>
                                                    <small>Copyright © ' .date('Y'). ' <strong>IT Department, RHQ-ER, AAI</strong> |
                                                    Powered by <strong>MIXblack</strong> |
                                                    All rights reserved.</small>
                                                </p>
                                            </div>
                                        </body>
                                    </html>';

                        $mail->addAddress($email, $name);
                        $mail->Subject = "Password Recovery Message from NOC Portal. ";
                        $mail->Body = $mail_body;

                        // Error Handling for PHPMailer
                        if(!$mail->Send()) {

                            $msg = "<script>
                                        swal({
                                        title: \"Oops..\",
                                        text: \"Email sending failed: $mail->ErrorInfo, error\",
                                        type: 'error',
                                        confirmButtonText: \"Try again\" });
                                    </script>"; 

                        } else {

                            $msg = "<script>
                                        swal({
                                        title: \"Password Recovery\",
                                        text: \"Password reset link sent successfully, please check your email address.\",
                                        type: 'success',
                                        confirmButtonText: \"Thank You!\" });
                                    </script>";

                        }
                        

                    }  else {

                        $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"The Email id provided does not exist in our database, please try again.\",
                                    type: 'error',
                                    confirmButtonText: \"Try again\" });
                                </script>"; 
        
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