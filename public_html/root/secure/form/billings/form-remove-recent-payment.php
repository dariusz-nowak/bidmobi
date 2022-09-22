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

    if (isset($_POST['bank_id'])) {
        $bank_id = $db->EscapeString($_POST['bank_id']);
    }
    $db->Query("DELETE FROM user_payments WHERE id = $bank_id");
    echo $bank_id;
}