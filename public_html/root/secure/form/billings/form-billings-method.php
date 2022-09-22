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
}
?>

<h3 class="mb-1">Bank information</h3>
<div class="col-md-12 bg-white pb-1 py-3 mt-3 row" style="border:none;border-radius:15px;height:81%;">
<div class = "py-2 px-2 col-md-12" style="border:solid;border-radius:15px;"><h5 class="mb-1">Details</h5></br>
<?php 
            $output = $db->QueryFetchArray("SELECT `bank_number`, `bank_name` FROM `user_payments_bank` WHERE {$user['id']}");
            echo '<div class = "ml-3 py-1" ><h5>'.$output["bank_name"].'</h5></div>
                  <div class = "mt-3 ml-3" >'.$output["bank_number"].'</div>';
?>
</div>
</div>