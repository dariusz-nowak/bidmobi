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

  require_once($root_path.'/root/secure/translation/en/online_true.php');

  // $get_user_company = $db->QueryFetchArray("SELECT * FROM user_company WHERE company_id = {$user['id']} LIMIT 1");

  $get_user_email = $db->QueryFetchArray("SELECT * FROM users WHERE id = {$user['id']} LIMIT 1");

  $email='';
  $company_name = '';
  $company_email = '';
  $first_name = '';
  $last_name = '';
  $address_line1 = '';
  $address_line2 = '';
  $address_line3 = '';
  $billing_email = '';
  if (isset($get_user_company['company_id'])) {
    $company_name = $get_user_company['company_name'];
    $company_email = $get_user_company['email'];
    $first_name = $get_user_company['first_name'];
    $last_name = $get_user_company['last_name'];
    $billing_email = $get_user_company['billing_email'];
    $address_line1 = $get_user_company['address_line1'];
    $address_line2 = $get_user_company['address_line2'];
    $address_line3 = $get_user_company['address_line3'];
  }
  if (isset($get_user_email['id'])){
    $email=$get_user_email['email'];
    $password=$get_user_email['password'];
  }
  ?>

    <div class="container col-12 " id="top">
      <div class="d-flex">

        <div class="col-md-5 mr-auto p-2 mt-2 " id="name_surname">
          <div class="container mt-3"><h4><?=$lang['settings_1']?></h4></div>
        </div>

        <div type="button" class="btn btn-lg my-3 mr-4" id="cl-add-app">
          <svg xmlns="http://www.w3.org/2000/svg"
            height="24"
            width="24"
            class="mr-1"
            fill="#ffffff">
            <path d="M10.425 19.575v-6h-6v-3.15h6v-6h3.15v6h6v3.15h-6v6Z"/>
          </svg>
          Add app
        </div>
        <div type="button" class="btn btn-lg my-3" id="cl-make-changes">
          <svg xmlns="http://www.w3.org/2000/svg"
            height="24"
            width="24" class="mr-1"
            fill="#ffffff">
            <path d="M5.075 19.175H6.25l8.325-8.35L13.4 9.65 5.075 18ZM19.725 9.4l-4.9-4.875.7-.725q1-1.025 2.4-1.038 1.4-.012 2.4.988l.7.725q.85.8.787 1.85-.062 1.05-.812 1.8ZM18.3 10.825 7.35 21.8H2.425v-4.9L13.4 5.95Zm-4.275-.575-.625-.6 1.175 1.175Z"/>
          </svg>
          Make changes
        </div>

      </div>

    </div>
    <div class="container col-12 p-2 my-5">
        <div class="col-12 row ">
            <div class="col-md-6">
                <div class="mb-4 mt-2"><h3><?= $lang['settings_1'] ?></h3></div>
                <div class="col-12 bm_container_dashboard_1 bg-white mb-4 py-2 "id="container_main">
                      <form action="" method="post">
                        <div class="mb-3">
                          <label for="company_name" class="form-label">Company name </label>
                          <input type="text" class="form-control" id="company_name" value="<?=$company_name?>" placeholder="Name">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">E-mail</label>
                          <input type="email" class="form-control" id="email" value="<?=$company_email?>" aria-describedby="emailHelp"placeholder="mail@mail.com">
                        </div>
                        <div class="mb-3">
                          <label for="first_name" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="first_name" value="<?=$first_name?>" placeholder="Name">
                        </div>
                        <div class="mb-3">
                          <label for="last_Name" class="form-label">Last Name </label>
                          <input  type="text" class="form-control" id="last_name" value="<?=$last_name?>" placeholder="Surname">
                        </div>
                        <div  id="cl-set-company" class="btn mt-1" >Submit</div>
                      </form>
                </div>
                <div class="col-12 bm_container_dashboard_1 bg-white mr-auto py-2" id="container_main1">
                      <form action="" method="post">
                        <div class="mb-3">
                          <label for="adress_line1" class="form-label">Address Line 1 </label>
                          <input type="text" class="form-control" id="address_line1"  value="<?=$address_line1?>" placeholder="Surname">
                        </div>
                        <div class="mb-3">
                          <label for="adress_line2" class="form-label">Address Line 2</label>
                          <input type="text" class="form-control" id="address_line2" value="<?=$address_line2?>" placeholder="Surname">
                        </div>
                        <div class="mb-3">
                          <label for="adress_line3" class="form-label">Address Line 3</label>
                          <input type="text" class="form-control" id="address_line3" value="<?=$address_line3?>" placeholder="Surname">
                        </div>
                        <div id="cl-set-address" class="btn mt-1" >Submit</button>
                      </form>
                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="mb-4 mt-2"><h3>Change your e-mail</h3></div>
                  <div class="col-12 bm_container_dashboard_1 bg-white py-2 " id="container_main2" >
                      <div class="mb-3">
                          <form action="" method="post">
                              <label for="new_email" class="form-label">New e-mail</label>
                              <input  type="email" class="form-control" id="new_email" value="<?=$email?>" placeholder="Type here">
                              <div id="cl-change-email" class="btn mt-4" >Submit</div>
                          </form>
                          <form action="" method="post" class="mt-4">
                              <label for="new_password" class="form-label">New password</label>
                              <input type="password" class="form-control" id="new_password" value="" placeholder="Type here">
                              <label for="confirm_new_password" class="form-label">Confirm new password</label>
                              <input type="password" class="form-control" id="confirm_new_password" value="" placeholder="Type here">
                              <div id="cl-change-password" class="btn mt-3" >Submit</div>
                          </form>
                      </div>
                  </div>
                <div class="my-4"><h3>Billing information</h3> </div>
                    <div class="col-12 bm_container_dashboard_1 bg-white py-2" id="container_main3">
                        <div class="mb-1 ">
                          <form action="" method="post">
                            <label for="exampleInputEmail1" class="form-label ">Billing e-mail</label>
                            <input  type="email" class="form-control " id="billing_email" value="<?=$billing_email?>" aria-describedby="emailHelp"placeholder="Type here">
                            <div  id="cl-set-billing" class="btn mt-3">Submit</div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php

}
