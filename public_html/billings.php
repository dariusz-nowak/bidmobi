<?php
# Detect localhost
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $root_path = $_SERVER['DOCUMENT_ROOT']."/platform-bidmobi/public_html";
} else {
  $root_path = $_SERVER['DOCUMENT_ROOT'];
}

include($root_path.'/root/secure/header/header.php');
?>

<div class="col py-3">
	<div id="load-container"></div>
</div>

<?php include($root_path.'/root/secure/footer/footer.php'); ?>
