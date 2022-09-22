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
  ;
  $bankAccountNumber = $_POST['ban'];
  $swift = $_POST['st'];
  $bankNumber = $_POST['bn'];
  $db->Query("INSERT INTO `user_payments_bank`(`user_id`, `payments_type`, `bank_number`, `bank_swift`, `bank_name`) VALUES ('{$user['id']}',0,'{$bankAccountNumber}','{$swift}','{$bankNumber}')");

}

