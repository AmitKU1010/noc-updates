<?php 

    // Include Database Conncection Script File
	include_once('resource/database.php');

	// Include Session File
	include_once('resource/session.php');

	// Include Utilities File
    include_once('resource/utilities.php');

    // Fetch all register users
    try {

        $stmt = $db->query("SELECT * FROM users");
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $ex) {

        $msg = flashMessage("An error occurred: " . $ex->getMessage());

    }