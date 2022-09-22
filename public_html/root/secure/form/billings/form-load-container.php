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




  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billings</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="/public_html/root/static/main.css">
    <script>
      $(function () {
        $('#save_button').bind('click', function (event) {
        event.preventDefault();
        var bankAccountNumber = $('#bank_account_number').val(); 
        var swift             = $('#swift').val();
        var bankName          = $('#bank_name').val();
        request =  $.ajax({
              type: 'POST',
              url: '/platform-bidmobi/public_html/root/secure/form/billings/form-set-bank',
              data:{
                ban : bankAccountNumber,
                st : swift,
                bn : bankName
              },
              success: function(response) {
                load_payment_methods();
    }
        
        }
      );

            });
          });
    </script>
  </head>
  <body>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalLabel">Payments</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Bank Account Number:</span>
              </div>
              <input autocomplete="off" id="bank_account_number" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Swift:</span>
              </div>
              <input autocomplete="off" id="swift" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Bank Name:</span>
              </div>
              <input autocomplete="off" id="bank_name" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="save_button" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="container col-12" id="top">
        <div class="d-flex">

                  <div class="col-md-5 mr-auto p-2 mt-2 " id="name_surname">
                    <div class="container mt-3 "><h4>Name Surname</h4></div>
                  </div>

                  <button style="border-radius:15px;" type="button" class="btn text-white button_blue my-3 mr-4" id="button1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      height="24"
                      width="24"
                      class="mr-1"
                      fill="#ffffff">
                      <path d="M10.425 19.575v-6h-6v-3.15h6v-6h3.15v6h6v3.15h-6v6Z"/>
                    </svg>
                    Add app

                  </button>
                  <button style="border-radius:15px;" type="button" class="btn text-white button_blue my-3"id="button2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      height="24"
                      width="24" class="mr-1"
                      fill="#ffffff">
                      <path d="M5.075 19.175H6.25l8.325-8.35L13.4 9.65 5.075 18ZM19.725 9.4l-4.9-4.875.7-.725q1-1.025 2.4-1.038 1.4-.012 2.4.988l.7.725q.85.8.787 1.85-.062 1.05-.812 1.8ZM18.3 10.825 7.35 21.8H2.425v-4.9L13.4 5.95Zm-4.275-.575-.625-.6 1.175 1.175Z"/>
                    </svg>
                    Make changes

                  </button>
        </div>
      </div>
      <div class="container col-12  pt-5 ml-1 row equal">
            <div class="col-6">
            <h3>Billings</h3>
              <div class="col-12 bg-white p-1 my-3 row ml-1" style="border-radius:15px;">
              <div class="mt-1 ml-5"><svg  xmlns="http://www.w3.org/2000/svg" height="48" width="48" ><circle cx="24" cy="24" r="19" stroke=""
                    stroke-width="3" fill="#0065ff" /><path fill="#ffffff" d="M22.65 34h3V22h-3ZM24 18.3q.7 0 1.175-.45.475-.45.475-1.15t-.475-1.2Q24.7 15 24 15q-.7 0-1.175.5-.475.5-.475
                     1.2t.475 1.15q.475.45 1.175.45ZM24 44q-4.1 0-7.75-1.575-3.65-1.575-6.375-4.3-2.725-2.725-4.3-6.375Q4 28.1 4 23.95q0-4.1 1.575-7.75 1.575-3.65
                      4.3-6.35 2.725-2.7 6.375-4.275Q19.9 4 24.05 4q4.1 0 7.75 1.575 3.65 1.575 6.35 4.275 2.7 2.7 4.275 6.35Q44 19.85 44 24q0 4.1-1.575 7.75-1.575
                       3.65-4.275 6.375t-6.35 4.3Q28.15 44 24 44Zm.05-3q7.05 0 12-4.975T41 23.95q0-7.05-4.95-12T24 7q-7.05 0-12.025 4.95Q7 16.9 7 24q0 7.05 4.975
                        12.025Q16.95 41 24.05 41ZM24 24Z"/> </svg></div>
              <div class="col-8 ml-0"><h6 class="p-1 my-3 text-center">Please note, payments will be made in $.</h6></div>
              </div>

              <div class="col-12 bg-white p-2" style="border-radius:15px;">
              <h4 class = "my-3 ml-1">General information</h4>
                <label class = "pb-2 ml-1">Name of the company, Name and Surname, mail<br>
                Adress: line 1, Line 2, city</label>
              </div>
            </div>
            <div  id="payments-div"class="col-6">
            <?php 
            $output = $db->QueryFetchArray("SELECT `id` FROM `user_payments_bank` WHERE {$user['id']}");
            if (empty($output)==TRUE){
              echo '<h3>Select Payout Method</h3>
              <button type="button" data-toggle="modal" data-target="#Modal"class="col-md-12 bg-white pb-1 py-3 mt-2 " style="border:none;border-radius:15px;height:81%;">
              <div class=" bg-white text-center justify-content-center align-items-center" style="border:solid; border-color:#0065ff;border-radius:15px;">
                <img class="m-3"style="max-width: 20%" src="https://www.svgrepo.com/show/131921/bank.svg" alt="placeholder"></br>
                <label class="mb-3"> Bank Transfer </label>
                </div>  
              </button>';
            } else {
              echo '<script>
              load_payment_methods();
              </script>';
              
            }
            ?>
              

          </div>
      </div>
      <div class="col-12 mt-5">
              <div class="row">
                <div class = "ml-3"><h3 class="ml-3">Recent Payments</h3></div>
                <div>
                <div class="col text-center ml-2 mb-2">
                <select class="button_gray py-2 px-2">
                <option selected>Last month</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option></select>
                </div>
                </div>
              </div>

              <div class="col-12">
              <table class = "col-12 bg-white m-1 text-center justify-content-center align-items-center" style="border-radius:30px;">
              <thead>
                <tr>
                  <th class="column_billings">Amount</th>
                  <th class="column_billings big_column" colspan="3">Date</th>
                  <th class="column_billings">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    $output = $db->Query("SELECT `transaction_value`, `bank_transaction`, `bank_details`, `bank_account_number`, `data_addded` FROM `user_payments` WHERE {$user['id']}");
                    foreach($output as $value){
                        echo '<tr>
                        <td class="column_billings">'.$value['transaction_value'].' USD</td>
                        <td class="column_billings big_column " colspan="3">'.$value['data_addded'].'</td>
                        <td class="column_billings">
                          <div class="row justify-content-center align-items-center">  
                          <div class="label_green py-1 px-2">NOT IMPLEMENTED</div>
                          <div class="ml-1"><button class="label_icon p-0"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m10 13.062-5-5L6.062 7 10 10.938 13.938 7 15 8.062Z"/></svg></button></div>
                          </div>
                        </td>
                      </tr>';
                    }
                ?>
              </tbody>
              </table>
              </div>
          </div>
          <style>
            .add-recent-payment-form {
              max-height: 0;
              overflow: hidden;
              visibility: hidden;
              transition: .4s;
            }
            .add-recent-payment-form.active {
              max-height: 300px;
              overflow: hidden;
              visibility: visible;
            }
          </style>
          <script> 
            document.querySelector('.button_add').addEventListener('click', () => document.querySelector('.add-recent-payment-form').classList.toggle('active'))
          </script>
          <div class="col-12 mt-5 column_billings">
              <h3 class = "ml-3">Recent Payments
                <div class="d-inline-block"><button class="button_add my-2"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg></button></div>
              </h3>
              <form action="" method="post" class="add-recent-payment-form">
                <label for="bank_name_value" class="form-label">Bank name</label>
                <input type="input" class="form-control" id="bank_name_value" value="" placeholder="Type here">
                <label for="bank_acc_number" class="form-label">Bank account number</label>
                <input type="number" class="form-control" id="bank_acc_number" value="" placeholder="Type here">
                <label for="transaction_value" class="form-label">Transaction value</label>
                <input type="number" class="form-control" id="transaction_value" value="" placeholder="Type here">
                <div id="add_recent_payment" class="btn mt-3 mb-3">Submit</div>
              </form>
              <div class="col-12 bg-white ml-3" style="border-radius:15px;">
              <div class="row equal">
                <?php
                    $output = $db->Query("SELECT `id`, `bank_transaction`, `bank_details`, `bank_account_number`, `data_addded` FROM `user_payments` WHERE {$user['id']} ORDER BY data_addded DESC");
                    foreach($output as $value){
                        echo '<div class="col-sm-1"><img class="m-2" style="max-width: 100%" src="https://www.svgrepo.com/show/51552/bank.svg" alt="placeholder"></div>
                        <div class="col-9 mt-1">
                        <div class = "mt-3">'.$value['bank_details'].' - '.$value['bank_account_number'].'</div>
                        </div>
                      <div class="col-1"><button class="button_edit my-2" id="edit_recent_payment"><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40">
                      <path fill="#0065ff" d="M30.458 13.167 27.5 10.208l1.833-1.833q.292-.292.709-.292.416 0 .75.334l1.5 1.5q.291.291.291.708t-.333.75Zm-.75.708L10.75 32.833H7.833v-2.916l18.959-18.959Z"/></svg></button></div>
                      
                      <form action="" method="post">
                      <input type="hidden" id="bank_id" value="'.$value['id'].'">
                      <div class="col-1" id="remove_recent_payment"><button class="button_edit my-2"><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40">
                      <path fill="#eb4934" d="M12.833 32.833q-1 0-1.666-.666Q10.5 31.5 10.5 30.5V9.75H8.833v-1h6.042V7.667h10.25V8.75h6.042v1H29.5V30.5q0 1-.667 1.667-.666.666-1.666.666Zm3.959-4.375h1V13.125h-1Zm5.416 0h1V13.125h-1Z"/></svg></button></div>
                      </form>
                      ';
                    }
                ?>
              </div>
            </div>
          </div>
  </body>
  </html>

  <?php
