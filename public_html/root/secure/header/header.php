<?php include($root_path.'/root/mysql/config.php'); ?>
<?php
if (!$is_online) {
  header("Location: $global_domain");
  exit();
}

if (!isset($user['name'])) {
  header("Location: $global_domain");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en-us" dir="ltr">
<head>

  <?php include($root_path.'/root/secure/meta/meta.php'); ?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=$global_domain?>/root/static/css/main.css?v=<?=$timestamp?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
  <link rel="stylesheet" href="<?=$global_domain?>/root/static/css/country.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>
<body>

  <div class="container-fluid">
  	<div class="row flex-nowrap">
  		<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-blue">
  			<div class="d-flex flex-column align-items-center align-items-sm-start pt-2 text-white min-vh-100">
  				<a href="/" class="d-flex align-items-center pl-3 pb-3 mt-3 mb-md-0 me-md-auto text-white text-decoration-none">
  				  <span class="fs-5 d-none d-sm-inline bm_logo_header">
              <img src="<?=$global_domain?>/root/static/img/logo-white.svg"></img>
            </span>
  				</a>
  				<ul class="nav nav-pills flex-column mb-sm-auto mt-3 mb-0 align-items-center align-items-sm-start" id="menu">
  					<li class="nav-item">
  						<a href="dashboard" class="nav-link align-middle px-3">
                <span class="material-symbols-outlined mr-3">insights</span><span class="ms-1 d-none d-sm-inline">Dashboard</span>
  						</a>
  					</li>
            <li class="nav-item mt-1">
  						<a href="billings" class="nav-link align-middle px-3">
                <span class="material-symbols-outlined mr-3">payments</span><span class="ms-1 d-none d-sm-inline">Billings</span>
  						</a>
  					</li>
            <li class="nav-item mt-1">
  						<a href="account" class="nav-link align-middle px-3">
                <span class="material-symbols-outlined mr-3">account_box</span><span class="ms-1 d-none d-sm-inline">Account</span>
  						</a>
  					</li>
            <li class="nav-item mt-1">
  						<a href="logout" class="nav-link align-middle px-3">
                <span class="material-symbols-outlined mr-3">account_box</span><span class="ms-1 d-none d-sm-inline">Log out</span>
  						</a>
  					</li>
          </ul>
        </div>
      </div>
