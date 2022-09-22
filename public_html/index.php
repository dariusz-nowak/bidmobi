<?php
# Detect localhost
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $root_path = $_SERVER['DOCUMENT_ROOT']."/platform-bidmobi/public_html";
} else {
  $root_path = $_SERVER['DOCUMENT_ROOT'];
}

include($root_path.'/root/mysql/config.php');

if ($is_online) {
  header("Location: $global_domain/dashboard");
}

$message = '';
if (isset($_POST['connect'])) {

  $email = $db->EscapeString($_POST['email']);
  $password = $db->EscapeString($_POST['password']);

  $user = $db->QueryFetchArray("SELECT id, account_type FROM users WHERE email = '$email' AND password = '$password'");

  if ($db->QueryGetNumRows("SELECT id FROM users WHERE email = '$email' LIMIT 1") == 0) {

    $message = "<div class='alert bg-danger text-white'><p class='mb-0'>User doesn't exist</p></div>";

  } elseif (!empty($user['id'])) {

    $_SESSION['s_bidmobi_ex'] = $user['id'];

    $db->Query("INSERT INTO user_session (user_id, ip, device, status, time_added) VALUES ('{$user['id']}', '$user_ip', '$user_device', '1', '$timestamp')");

    header("Location: $global_domain/dashboard");

  } else {

    $message = "<div class='alert bg-danger text-white'><p class='mb-0'>Provided data are invalid</p></div>";

  }

}
?>
<!DOCTYPE html>
<html lang="en-us" dir="ltr">
<head>

  <?php include($root_path.'/root/secure/meta/meta.php'); ?>

  <link rel="stylesheet" href="<?=$global_domain?>/root/static/css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <style>
  .logo-nl-size {
    max-height: 42px;
  }
  </style>

</head>
<body>

<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-sm-6 col-md-4">
      <div class="w-100 text-center mb-5" style="margin-top:-3rem!important">
        <img src="<?=$global_domain?>/root/static/img/logo.svg" class="logo-nl-size">
      </div>
      <h3 class="text-center mb-4">Sign in</h3>
      <form method="POST" class="form-signin">
        <?=$message?>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="text" name="email" class="form-control form-control-lg" id="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control form-control-lg" id="password">
        </div>
        <button class="btn btn-lg btn-primary btn-block mt-4 mb-4" type="submit" name="connect">Sign in</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
