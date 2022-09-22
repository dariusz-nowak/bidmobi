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

	$new_email = '';
	if (isset($_POST['new_email'])) {
      $new_email = $db->EscapeString($_POST['new_email']);
    }
	if (
		!filter_var($new_email, FILTER_VALIDATE_EMAIL) ||
		strlen($new_email) > 40 ||
		strpos($new_email, '\\') !== false ||
		strpos($new_email, '/') !== false ||
		strpos($new_email, '*') !== false ||
		strpos($new_email, '!') !== false ||
		strpos($new_email, '(') !== false ||
		strpos($new_email, ')') !== false
	) {

		echo 1;

	} elseif ($db->QueryGetNumRows("SELECT id FROM users WHERE email = '$new_email' LIMIT 1") > 0) {

		echo 2;

	} else {

		$db->Query("UPDATE users SET email = '$new_email' WHERE id = {$user['id']}");

		echo 100;

	}

}
