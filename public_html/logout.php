<?php
# Detect localhost
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $root_path = $_SERVER['DOCUMENT_ROOT']."/platform-bidmobi/public_html";
} else {
  $root_path = $_SERVER['DOCUMENT_ROOT'];
}

include($root_path.'/root/mysql/config.php');

if (isset($_SESSION['s_bidmobi_ex'])) {

  if ($user['id'] > 0) {

		$db->Query("INSERT INTO user_session (user_id, ip, device, status, time_added) VALUES ('{$user['id']}', '$user_ip', '$user_device', '0', '$timestamp')");

  }

  session_destroy();

  setcookie('bm_login', null, -1, '/', 'platform.bidmobi.com');

}

header("Location: $global_domain");
