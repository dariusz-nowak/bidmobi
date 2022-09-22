<?php
# Detect localhost
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $root_path = $_SERVER['DOCUMENT_ROOT']."/platform-bidmobi/public_html";
} else {
  $root_path = $_SERVER['DOCUMENT_ROOT'];
}

$form_type = basename(__FILE__, '.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once($root_path.'/root/mysql/config.php');

	$company_name = '';
	if (isset($_POST['company_name'])) {
    $company_name = $db->EscapeString($_POST['company_name']);
    $email = $db->EscapeString($_POST['email']);
    $first_name = $db->EscapeString($_POST['first_name']);
    $last_name = $db->EscapeString($_POST['last_name']);
  }


	if (
			strlen($company_name) > 40 ||
			strpos($company_name, '\\') !== false ||
			strpos($company_name, '/') !== false ||
			strpos($company_name, '*') !== false ||
			strpos($company_name, '!') !== false ||
			strpos($company_name, '(') !== false ||
			strpos($company_name, ')') !== false
		) 
	{

		echo 1;

	} 
	elseif(
		!filter_var($email, FILTER_VALIDATE_EMAIL) ||
		strlen($email) > 40 ||
		strpos($email, '\\') !== false ||
		strpos($email, '/') !== false ||
		strpos($email, '*') !== false ||
		strpos($email, '!') !== false ||
		strpos($email, '(') !== false ||
		strpos($email, ')') !== false
		)
	{
		echo 2;
	}
	elseif ($db->QueryGetNumRows("SELECT id FROM user_company WHERE email = '$email' LIMIT 1") > 0) 
	{

		echo 3;

	} 
	elseif(
		strlen($first_name) > 30 ||
		strpos($first_name, '\\') !== false ||
		strpos($first_name, '/') !== false ||
		strpos($first_name, '*') !== false ||
		strpos($first_name, '!') !== false ||
		strpos($first_name, '(') !== false ||
		strpos($first_name, ')') !== false

	)
	{

		echo 4;

	}
	elseif
	(
		strlen($last_name) > 30 ||
		strpos($last_name, '\\') !== false ||
		strpos($last_name, '/') !== false ||
		strpos($last_name, '*') !== false ||
		strpos($last_name, '!') !== false ||
		strpos($last_name, '(') !== false ||
		strpos($last_name, ')') !== false
	)
	{

		echo 5;

	}	
	elseif ($db->QueryGetNumRows("SELECT company_id FROM user_company WHERE id = {$user['id']} LIMIT 1") > 0) {
    
		$db->Query("UPDATE user_company SET company_name = '$company_name', email = '$email', first_name = '$first_name' , last_name = '$last_name' WHERE company_id = {$user['id']}");
		
		echo 100;
	} else {
		
		$db->Query("INSERT INTO user_company (company_name, email, first_name, last_name) VALUES ('{$user['id']}', '$company_name', '$email', '$first_name','$last_name')");
		
		echo 100;
	}

}
