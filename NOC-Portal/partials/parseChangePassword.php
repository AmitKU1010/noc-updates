<?php 

    // Include Database Conncection Script File
	include_once('../resource/database.php');

	// Include Session File
	include_once('../resource/session.php');

	// Include Utilities File
    include_once('../resource/utilities.php');

    // Fetch User Details
    if(isset($_POST['emp_change_password'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */
            
            // Initialize an array to store any error message from the form
            $form_errors = array();

            // Form validation
            $required_fields = array('current_password', 'new_password', 'confirm_password');

            // Call the function to check empty field and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            // Fields that requires checking for minimum length
            $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

            // Call the function to check minimum required length and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

            // Check if error array is empty, if yes process form data
            if(empty($form_errors)) {

                $id = $_POST['hidden_id'];
                $current_password = $_POST['current_password'];
                $password1 = $_POST['new_password'];
                $password2 = $_POST['confirm_password'];

                // Check if new password and confirm password is same
                if($password1 != $password2) {

                    $msg = "<script>
                        swal({
                        title: \"Oops..\",
                        text: \"Passwords does not matched.\",
                        type: 'error',
                        confirmButtonText: \"Try again\" });
                    </script>";

                } else {

                    try {

                        // Process request // Check if the old password is correct
                        $sql = "SELECT password FROM users WHERE id = :id";
    
                        // Use PDO prepared to sanitize data
                        $stmt = $db->prepare($sql);
    
                        // Update the record in the database
                        $stmt->execute(array(':id' => $id));

                        // Check if record is found
                        if($row = $stmt->fetch()) {

                            $password_from_db = $row['password'];

                            if(password_verify($current_password, $password_from_db)) {

                                // Hashed new password
                                $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                                // SQL statement for update password
                                $sql = "UPDATE users SET password = :password WHERE id = :id";
                                $stmt = $db->prepare($sql);
                                $stmt->execute(array(':password' => $hashed_password, ':id' => $id));

                                if($stmt->rowCount() === 1) {

                                    $msg = "<script>
                                            swal({
                                            title: \"Congratulations!\",
                                            text: \"Password Successfully Updated.\",
                                            type: 'success',
                                            timer: 3000,
                                            showConfirmButton: false });

                                            setTimeout(function(){
                                                window.location.href = 'profile.php';
                                            }, 2000);
                                        </script>";

                                } else {

                                    $msg = "<script>
                                            swal({
                                            title: \"Oops..\",
                                            text: \"No changes saved\",
                                            type: 'error',
                                            confirmButtonText: \"Try again\" });
                                        </script>";

                                }

                            } else {

                                $msg = "<script>
                                            swal({
                                            title: \"Oops..\",
                                            text: \"Old password is not correct, please try again\",
                                            type: 'error',
                                            confirmButtonText: \"Ok\" });
                                        </script>";

                            }

                        }
    
                    } catch (PDOException $ex) {
                        $msg = flashMessage("An error occurred in: " . $ex->getMessage());   
                    }

                }

                

            } else {

                if(count($form_errors) == 1) {
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
