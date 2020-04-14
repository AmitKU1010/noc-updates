<?php 

    /**
     * @param $required_fields_array, n array containing the list of all required fields 
     * @return array, containing all errors
    */

    function check_empty_fields ($required_fields_array) {

        // Initialize an array to store error messages
        $form_errors = array();

        // Loop through the required fields array snd popular the form error array
        foreach ($required_fields_array as $name_of_field) {
            if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
                $form_errors[] = $name_of_field . " is required";
            }
        }

        return $form_errors;

    }

    /**
     * @param $fields_to_check_length, an array containing the name of fields
     * for which we want to check min required length e.g. array('username' => 4, 'email' => 12)
     * @return array, containing all errors
    */

    function check_min_length ($fields_to_check_length) {

        // Initialize an array to store error message
        $form_errors = array();

        foreach ($fields_to_check_length as $name_of_field => $minimum_length_required) {
            if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
                $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long";
            }
        }

        return $form_errors;

    }

    /**
     * @param $table, table that we want to search
     * @param $column_name, the column name
     * @param $value, the data collected from the form
     * @param $db, database object
     * @return bool, returns true if record exist else false
    */

    function checkDuplicateEntries($table, $column_name, $value, $db) {

        try {

            $sql = "SELECT * FROM $table WHERE $column_name = :$column_name";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(":$column_name" => $value));

            if ($row = $stmt->fetch()) {

                return true;

            }

            return false;

        } catch (PDOException $ex) {
            // Handle exception
        }

    }

    /**
     * @param $data, store a key/value pair array where key is the name of the form control
     * in this case 'email' and value is the input entered by the user
     * @return array, containing all errors
    */

    function check_email ($data) {

        // Initialize an array to store error messages
        $form_errors = array();
        $key = 'email';

        // Check if the key email exist in data array
        if (array_key_exists($key, $data)) {

            // Check if the email field has a value
            if ($_POST[$key] != null) {

                // Remove all illegal characters from email
                filter_var($_POST[$key], FILTER_SANITIZE_EMAIL);

                // Check if input is a valid email address
                if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {

                    $form_errors[] = $key . " is not a valid email address";
                }

            }

        }

        return $form_errors;

    }

    /**
     * @param $form_errors_array, the array holding all
     * errors which we want to loop through
     * @return string, list containing all error messages
    */

    function show_errors ($form_errors_array) {
        $msg = '';
				
        $msg .= "<ul>";

        // Loop through error array and display all items in a list
        foreach ($form_errors_array as $the_error) {
            $msg .= "<li> {$the_error} </li>";
        }

        $msg .= "</ul> </div>";

        return $msg;

    }

    // Message Function
    function flashMessage ($message, $passOrFail = "Fail") {

        if ($passOrFail == "Pass") {
            $data = "<div class='alert alert-success'> {$message} </div>";
        } else {
            $data = "<div class='alert alert-danger'> {$message}";
        }

        return $data;

    }

    // Redirection function
    function redirectTo ($folder, $page) {

        header("Location: {$folder}/{$page}.php");

    }

    // Get All Hod's Id
    function getAllHodIds($table, $column_name, $value, $db) {

        try {

            $sql = "SELECT * FROM $table WHERE $column_name = :$column_name";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(":$column_name" => $value));

            if ($row = $stmt->fetch()) {

                return true;

            }

            return false;

        } catch (PDOException $ex) {
            // Handle exception
        }

    }

    // Check duplicate username
    function checkDuplicateUsername ($value, $db) {

        try {

            $sql = "SELECT username FROM users WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':username' => $value));

            if ($row = $stmt->fetch()) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {

            // Handle exception

        }

    }

    // Check duplicate Request
    function checkDuplicateRequest ($value,$status, $db) {

        try {

            $sql = "SELECT user_id, type FROM request WHERE user_id = :user_id AND type = :type";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':user_id' => $value, ':type' => $status));

            if ($row = $stmt->fetch()) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {

            // Handle exception

        }

    }

    // Check duplicate Email
    function checkDuplicateEmail ($value, $db) {

        try {

            $sql = "SELECT email FROM users WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':email' => $value));

            if ($row = $stmt->fetch()) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {

            // Handle exception

        }

    }

    /**
     * @param $user_id
    */

    function rememberMe ($user_id) {

        $encryptCookieData = base64_encode("UaQteh5i4y3dntstemYODEC{$user_id}");

        // Cookie set to expire in about 30 days
        setcookie("rememberUserCookie", $encryptCookieData, time()+60*60*24*100, "/");

    }

    /**
     * Checked if the cookie used is same with the encrypted cookie
     * @param $db, database connection link
     * @return bool, true if the user cookie is valid
    */

    function isCookieValid($db) {

        $isValid = false;

        if (isset($_COOLIE['rememberUserCookie'])) {

            /**
             * Decode cookies and extract user ID
            */

            $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
            $user_id = explode("UaQteh5i4y3dntstemYODEC", $decryptCookieData);
            $userID = $user_id[1];

            /**
             * Check if id retrieved from the cookie exist in the database
            */

            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':id' => $userID));

            if ($row = $stmt->fetch()) {

                $id = $row['id'];
                $email = $row['email'];

                // Create the user session variable
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $isValid = true;

            } else {

                // Cookie ID is invalid destroy session and logout user
                $isValid = false;
                $this->signout();

            }

        }

        return $isValid;

    }

    function signout() {

        unset($_SESSION['email']);
        unset($_SESSION['id']);

        if (isset($_COOKIE['rememberUserCookie'])) {

            unset($_COOKIE['rememberUserCookie']);
            setcookie('rememberUserCookie', null, -1, '/');

        }

        session_destroy();
        session_regenerate_id(true);
        header('Location: http://localhost/MIXblack/AAI%20Projects/Final%20Projects/NOC%20Portal/login.php');

    }

    // 
    function guard() {

        $isValid = true;
        $inactive = 60 * 30; // 2 mins
        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        if ((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint)) {

            $isValid = false;
            signout();

        } else if ((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['email']) {

            $isValid = false;
            signout();

        } else {
            $_SESSION['last_active'] = time();
        }

        return $isValid;

    }

    // Validate Image
    function isValidImage($file) {

        $form_errors = array();

        // Split file name into an array using the dot (.)
        $part = explode(".", $file);

        // Target the last element in the array
        $extension = end($part);

        switch(strtolower($extension)) {

            case 'jpg' :

            case 'gif' :

            case 'bmp' :

            case 'png' :

            return $form_errors;

        }

        $form_errors[] = $extension . " is not a valid image extension";
        return $form_errors;

    }

    // Upload Image
    function uploadAvatar($name) {

        $isImageMoved = false;

        if ($_FILES['avatar']['tmp_name']) {

            // File in the temp location
            $temp_file = $_FILES['avatar']['tmp_name'];
            $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $filename = $name . md5(microtime()) . ".{$ext}";

            $path = "../uploads/{$filename}";

            move_uploaded_file($temp_file, $path);

            return $path;

        }

        return $isImageMoved;

    }

    // Generate Token
    function _token() {

        if(!isset($_SESSION['token'])) {

            $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
            return $_SESSION['token'] = $randomToken;

        }

        return $_SESSION['token'];

    }

    // Validate generated token
    function validate_token($requestToken) {

        if(isset($_SESSION['token']) && $requestToken === $_SESSION['token']) {

            unset($_SESSION['token']);

            return true;

        }

        return false;

    }

    // User login function
    function prepUserLogin ($role, $id, $name, $email, $remember) {

        $_SESSION['role'] = $role;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;

        // 
        $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        $_SERVER['last_active'] = time();
        $_SERVER['fingerprint'] = $fingerprint;

        // Remember Me box clicked
        if ($remember === "yes") {
            rememberMe($id);
        }

        if ($_SESSION['role'] === '0') {

            header('Location: employee/index.php');
        
        } else if ($_SESSION['role'] === '1') {

            header('Location: hod/index.php');
        
        } else if ($_SESSION['role'] === '2') {

            header('Location: admin/index.php');
        
        }


    }