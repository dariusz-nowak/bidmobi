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


	$address_line1 = '';
	if (isset($_POST['address_line1'])) {
	$address_line1 = $db->EscapeString($_POST['address_line1']);
	$address_line2 = $db->EscapeString($_POST['address_line2']);
	$address_line3 = $db->EscapeString($_POST['address_line3']);
  }
	if (
		strlen($address_line1) > 40 ||
		strpos($address_line1, '\\') !== false ||
		strpos($address_line1, '*') !== false ||
		strpos($address_line1, '!') !== false ||
		strpos($address_line1, '(') !== false ||
		strpos($address_line1, ')') !== false
	) {

		echo 1;

	} elseif (
		strlen($address_line2) > 40 ||
		strpos($address_line2, '\\') !== false ||
		strpos($address_line2, '*') !== false ||
		strpos($address_line2, '!') !== false ||
		strpos($address_line2, '(') !== false ||
		strpos($address_line2, ')') !== false
	) {

		echo 2;

	} elseif (
		strlen($address_line3) > 40 ||
		strpos($address_line3, '\\') !== false ||
		strpos($address_line3, '*') !== false ||
		strpos($address_line3, '!') !== false ||
		strpos($address_line3, '(') !== false ||
		strpos($address_line3, ')') !== false
	){
		echo 3;
	}
	elseif ($db->QueryGetNumRows("SELECT company_id FROM user_company WHERE id = {$user['id']} LIMIT 1") > 0) {
    
		$db->Query("UPDATE user_company SET address_line1 = '$address_line1', address_line2 = '$address_line2', address_line3 = '$address_line3' WHERE company_id = {$user['id']}");
		
		echo 100;
	} else {
		
		$db->Query("INSERT INTO user_company (address_line1, address_line2, address_line3) VALUES ('{$user['id']}', '$address_line1', '$address_line2', '$address_line3')");
		
		echo 100;
	}
}
