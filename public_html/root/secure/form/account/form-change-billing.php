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
  

	$billing_email = '';
	if (isset($_POST['billing_email'])) {
    $billing_email = $db->EscapeString($_POST['billing_email']);
  }

	if (
		!filter_var($billing_email, FILTER_VALIDATE_EMAIL) ||
		strlen($billing_email) > 40 ||
		strpos($billing_email, '\\') !== false ||
		strpos($billing_email, '/') !== false ||
		strpos($billing_email, '*') !== false ||
		strpos($billing_email, '!') !== false ||
		strpos($billing_email, '(') !== false ||
		strpos($billing_email, ')') !== false
	) {

		echo 1;

	} elseif ($db->QueryGetNumRows("SELECT id FROM user_company WHERE billing_email = '$billing_email' LIMIT 1") > 0 ) {

		echo 2;

	} else {

		$db->Query("UPDATE user_company SET billing_email = '$billing_email' WHERE id = {$user['id']}");

		echo 100;

	}

}
