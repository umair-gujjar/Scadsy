<?php

$database_get_file = "../application/config/_database.php";
$database_push_file = "../application/config/database.php";
$sql_file = "install.sql";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
	// Load the database connection
	$dbh = new PDO($_POST['db_driver'].':host='.$_POST['db_host'].';dbname='.$_POST['db_name'], $_POST['db_user'], $_POST['db_pass']);
	
	$dbh->query(get_prepared_sql($sql_file));
	
	$dbh = NULL;
	
	// Save the inserted settings
	$file_content = file_get_contents($database_get_file);
	$file_content = str_replace("{DB_NAME}", $_POST['db_name'], $file_content);
	$file_content = str_replace("{DB_DRIVER}", $_POST['db_driver'], $file_content);
	$file_content = str_replace("{DB_HOST}", $_POST['db_host'], $file_content);
	$file_content = str_replace("{DB_USER}", $_POST['db_user'], $file_content);
	$file_content = str_replace("{DB_PASS}", $_POST['db_pass'], $file_content);

	if (file_put_contents($database_push_file, $file_content) === FALSE ) {
		echo 'Something went wrong with writing the settings. Please make sure "'.$database_push_file.'" has the correct filepermissions.';
	} else {
		echo file_get_contents('succes.html');
	}
	
	} catch (PDOException $e) {
		echo "An error occured: " . $e->getMessage();
		die();
	}
} else {
	echo file_get_contents('form.html');
}


function get_prepared_sql($sql_file) {
	$sql = file_get_contents($sql_file);
	$sql = str_replace("{USERNAME}", $_POST['username'], $sql);
	$sql = str_replace("{PASSWORD}", password_hash($_POST['password'], PASSWORD_DEFAULT), $sql);
	$sql = str_replace("{EMAIL}", $_POST['email'], $sql);
	$sql = str_replace("{FIRST_NAME}", $_POST['first_name'], $sql);
	$sql = str_replace("{LAST_NAME}", $_POST['last_name'], $sql);
	$sql = str_replace("{GENDER}", $_POST['gender'], $sql);
	$sql = str_replace("{DATE_OF_BIRTH}", $_POST['date_of_birth'], $sql);
	$sql = str_replace("{PHONE_NUMBER}", $_POST['phone_number'], $sql);
	return $sql;
}