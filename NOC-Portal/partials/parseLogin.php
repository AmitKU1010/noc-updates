<?php

    // Include Session File
	include_once('resource/session.php');

	// Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Utilities File
	include_once('resource/utilities.php');
 
    // ============== START LOGIN PROCESS ===============
	if (isset($_POST['login_btn'], $_POST['token'])) {

        // Validate the token
        if(validate_token($_POST['token'])) {

            /** 
             *  Process the form
            */
            
            // Array to hold errors
            $form_errors = array();

            // Validate
            $required_fields = array('email', 'password');

            // Call the function to check empty field and merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

            // Email validation / merge the return data into form_error array
            $form_errors = array_merge($form_errors, check_email($_POST));

            if (empty($form_errors)) {

                // Collect from data
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Check user click remember box or not?
                isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";

                // Check if user exist in the database
                $sql = "SELECT * FROM users WHERE email = :email";

                $stmt = $db->prepare($sql);

                $stmt->execute(array(':email' => $email));

                if ($row = $stmt->fetch()) {

                    $id = $row['id'];
                    $hashed_password = $row['password'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $role = $row['role'];
                    $activated = $row['activated'];

                    if($activated === "0") {

                        if(checkDuplicateEntries('trash', 'user_id', $id, $db)) {

                            // Activated the account
                            $db->exec("UPDATE users SET activated = '1' WHERE id = $id LIMIT 1");

                            // Remove info from trash table
                            $db->exec("DELETE FROM trash WHERE user_id = $id LIMIT 1");

                            // Login the User
                            prepUserLogin($role, $id, $name, $email, $remember);

                        } else {

                            $msg = "<script>
                                    swal({
                                    title: \"Account Not Activated\",
                                    text: \"Please check your registered email for activate your account.\",
                                    type: 'error',
                                    confirmButtonText: \"Ok\" });
                                </script>";

                        }
                    
                    } else {

                        if (password_verify($password, $hashed_password)) {

                            // Login the User
                            prepUserLogin($role, $id, $name, $email, $remember);
    
                        } else {
                            
                            $msg = "<script>
                                        swal({
                                        title: \"Oops..\",
                                        text: \"You have entered an invalid Password\",
                                        type: 'error',
                                        confirmButtonText: \"Try again\" });
                                    </script>"; 
    
                        }

                    }

                } else {

                    $msg = "<script>
                                swal({
                                title: \"Oops..\",
                                text: \"You have entered an invalid Email Address\",
                                type: 'error',
                                confirmButtonText: \"Try again\" });
                            </script>"; 

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

    // ============== END LOGIN PROCESS ===============

