<?php 

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Session File
    include_once('resource/session.php');

	// Include Utilities File
    include_once('resource/utilities.php');

    // Include Send Email File
	include_once('resource/send-email.php');

    // Fetch User Details
    if(isset($_POST['mix_delete_account'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */
            
            $id = $_POST['hidden_id'];

            try {

                // STEP 1: Retrieve user information from the database
                $sql = "SELECT * FROM users WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->execute(array(':id' => $id));

                if($row = $stmt->fetch()) {

                    // STEP 2: Deactivate the account
                    $username = $row['username'];
                    $email = $row['email'];
                    $user_id = $row['id'];

                    $deactivateQuery = $db->prepare("UPDATE users SET activated = :activated WHERE id = :id");
                    $deactivateQuery->execute(array(':activated' => 0, ':id' => $user_id));

                    if ($deactivateQuery->rowCount() === 1) {

                        // STEP 3: Insert record into the deleted users table
                        $insertRecord = $db->prepare("INSERT INTO trash(user_id, deleted_at) VALUES(:id, now())");

                        $insertRecord->execute(array(':id' => $user_id));

                        if ($insertRecord->rowCount() === 1) {

                            // STEP 4: Send notification to the user via email and display confirmation alert
                            // Prepare email body
                            $mail_body = '<html>
                                            <body style="color:#333; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
                                                <div style="text-align:center;">
                                                    <h1 style="font-size:2rem; margin-bottom:30px;">Dear '.$username.'!</h1>

                                                    <p style="font-size:1rem;">You have requested to deactivate your account, your account information will be kept for 14 days. If you wish to continue using this system login within the next 14 days to activate your account or it will be permanently deleted.</p>

                                                    <center>
                                                        <div style="width:200px; padding:10px; background-color:#00b7eb; color:#fff; margin-top:40px; margin-bottom:40px;">
                                                            <a style="text-decoration:none; color:#fff;" target="_blank" href="http://localhost/MIXblack/RND/PROJECTS/login-system/mix-login.php">Login Now</a>
                                                        </div>
                                                    </center>

                                                    <p style="margin-bottom:40px; font-size:1rem;">
                                                        if you have any questions, just replay to this email - we\'re always happy to help out.
                                                    </p>

                                                    <p style="margin-bottom:40px">
                                                        Cheers,
                                                        <br/>
                                                        <strong>IT Department Team, RHQ-ER, AAI</strong>
                                                    </p>

                                                    <p>
                                                        <small>Copyright © 2020 <strong>IT Department, RHQ-ER, AAI</strong>. 
                                                        Powered by <strong>MIXblack</strong> 
                                                        All rights reserved.</small>
                                                    </p>
                                                </div>
                                            </body>
                                        </html>';

                            $mail->addAddress($email, $username);
                            $mail->Subject = "Account Deactivation Message from IT Department, RHQ-ER, AAI. ";
                            $mail->Body = $mail_body;

                            // Error Handling for PHPMiler
                            if (!$mail->Send()) {

                                $msg = "<script>
                                            swal({
                                            title: \"Oops..\",
                                            text: \"Email sending failed: $mail->ErrorInfo\",
                                            type: 'error',
                                            confirmButtonText: \"Ok\" });
                                        </script>";

                            } else {

                                $msg = "<script>
                                            swal({
                                            title: \"Dear $username\",
                                            text: \"You have requested to deactivate your account, your account information will be kept for 14 days. If you wish to continue using this system login within the next 14 days to activate your account or it will be permanently deleted.\",
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'logout.php';
                                            }, 2000);
                                        </script>";

                            }


                        } else {

                            $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"Couldn't complete the operation, please try again\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                        }

                    } else {

                        $msg = "<script>
                                    swal({
                                    title: \"Oops..\",
                                    text: \"Couldn't complete the operation, please try again\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                    }

                } else {

                    // Something fishing delete cookies and sessions
                    signout();

                }


            } catch (PDOException $ex) {

                $msg = flashMessage("An error occurred: " . $ex->getMessage());

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
