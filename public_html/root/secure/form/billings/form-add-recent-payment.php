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

	if (isset($_POST['bank_name_value'])) {
    $bank_name_value = $db->EscapeString($_POST['bank_name_value']);
    $bank_acc_number = $db->EscapeString($_POST['bank_acc_number']);
    $transaction_value = $db->EscapeString($_POST['transaction_value']);
  }

	if (empty(strlen($bank_name_value))) { 
		echo 1;
	} elseif (empty(strlen($bank_acc_number))) { 
		echo 2;
	} elseif (empty(strlen($transaction_value))) { 
		echo 3;
	} else {
    $db->Query("INSERT INTO user_payments (user_id, transaction_value, bank_transaction, bank_details, bank_account_number, data_addded) VALUES (1, $transaction_value, 0, '$bank_name_value', $bank_acc_number, NOW())");
    echo 100;
	}
}