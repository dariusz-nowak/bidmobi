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

	$new_password = '';
	if (isset($_POST['new_password'])) {
      $new_password = $db->EscapeString($_POST['new_password']);
      $confirm_new_password = $db->EscapeString($_POST['confirm_new_password']);
    }

	if (strlen($new_password) > 40) {

		echo 1;

	} elseif (
        $db->QueryGetNumRows("SELECT id FROM users WHERE password = '$new_password' LIMIT 1") > 0 ||
        strlen($new_password) === 0 
    ) {
		echo 2;
        
	} elseif($new_password != $confirm_new_password) {
		echo 3;
    }
    else {
		$db->Query("UPDATE users SET password = '$new_password' WHERE id = {$user['id']}");
		echo 100;
	}

}
