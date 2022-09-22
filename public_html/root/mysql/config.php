<?php
header("Content-Security-Policy: frame-ancestors 'none'");
session_start();
ob_start();

//======================================================================
// CUSTOM SETTINGS
//======================================================================

/*
$is_error_test = false;
$test_ip = array(
	'62.3.38.141'
);
if (in_array($_SERVER['REMOTE_ADDR'], $test_ip)) {
	$is_error_test = true;
	error_reporting(~0);
	ini_set('display_errors', 1);
}
*/
error_reporting(~0);
ini_set('display_errors', 1);

//======================================================================
// SETUP
//======================================================================

$activepage = basename($_SERVER['PHP_SELF'], '.php');
$user_device = $_SERVER['HTTP_USER_AGENT'];
$time = date('Y-m-d H:i:s');
$timestamp = time();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $user_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $user_ip = $_SERVER['REMOTE_ADDR'];
}
$pre_create_path_1 = explode('?', $_SERVER['REQUEST_URI']);
$pre_create_path_2 = explode('&', $pre_create_path_1[0]);
$create_path = explode('/', $pre_create_path_2[0]);

//-----------------------------------------------------
// DETECT LOCALHOST
//-----------------------------------------------------

if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $is_xampp = true;
} else {
  $is_xampp = false;
}
if ($is_xampp) {
  $global_domain = "http://localhost/platform-bidmobi/public_html";
} else {
  $global_domain = 'https://'.$_SERVER['SERVER_NAME'];
}

//======================================================================
// DATABASE CONNECTION
//======================================================================

include($root_path.'/root/mysql/database.php');
include($root_path.'/root/mysql/functions.php');
include($root_path.'/root/mysql/connection.php');

$db = new MySQLConnection($config['sql_host'], $config['sql_username'], $config['sql_password'], $config['sql_database']);
$db->Connect();
unset($config['sql_password']);

//======================================================================
// USER SESSION
//======================================================================

$is_online = false;
if (isset($_SESSION['s_bidmobi_ex'])) {
	$ses_id = $db->EscapeString($_SESSION['s_bidmobi_ex']);
	if (is_numeric($ses_id)) {
		$user	= $db->QueryFetchArray("SELECT id, email, name, account_type FROM users WHERE id = $ses_id LIMIT 1");
		if (!isset($_COOKIE['bm_login'])) {
			setcookie('bm_login', $user['id'], time() + 2592000, '/', 'platform.bidmobi.com');
		}
	}
	$is_online = true;
	if (empty($user['id'])) {
		session_destroy();
		$is_online = false;
	}
}
if (!$is_online) {
	if (isset($_COOKIE['bm_login'])) {
		if ($user_ip == $test_ip) {
			if ($_COOKIE['bm_login'] != 1) {
				$get_user_session = $db->QueryFetchArray("SELECT status FROM user_session ORDER BY time_added DESC LIMIT 1");
				if (isset($get_user_session['status']) && $get_user_session['status'] == 1) {
					$_SESSION['s_bidmobi_ex'] = $_COOKIE['bm_login'];
					$user = $db->QueryFetchArray("SELECT id, email, name, account_type FROM users WHERE id = {$_COOKIE['bm_login']} LIMIT 1");
					$db->Query("INSERT INTO user_session (user_id, ip, device, status, time_added) VALUES ('{$user['id']}', '$user_ip', '$user_device', '1', '$timestamp')");
					if (isset($form_type)) {
						echo 'Session expired. Please refresh the page.';
						exit();
					} else {
						header("Location: $global_domain");
					}
				}
			}
		}
	}
} else {
	if (isset($_COOKIE['bm_login'])) {
		if ($_COOKIE['bm_login'] != $user['id']) {
			setcookie('bm_login', $user['id'], time() + 2592000, '/', 'platform.bidmobi.com');
		}
	}
}

//======================================================================
// LANGUAGES
//======================================================================

include($root_path.'/root/secure/array/array-language-code.php');

function sQuote($string) {
	if (strpos($string, "'") !== false) {
		return str_replace("'", '&#039;', $string);
	} else {
		return $string;
	}
}
// $lang = array_map('sQuote', $lang);

if ($activepage != 'index') {
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$is_online) {
		exit();
	}
}
