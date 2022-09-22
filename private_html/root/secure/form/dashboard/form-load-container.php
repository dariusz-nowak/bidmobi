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

  $get_user_keys = $db->QueryFetchArray("SELECT * FROM user_keys");

  $start_date = '1659647711';
  $end_date = $timestamp;

  $publisher_id = $get_user_keys['digital_turbine_publisher_id'];
  $consumer_key = $get_user_keys['digital_turbine_consumer_key'];
  $consumer_secret = $get_user_keys['digital_turbine_consumer_secret'];

  // consumer_secret -> to nie wiadomo jak zrobic, Computed OAuth 2.0 OAuth signature musi byc -- https://oauth.net/core/1.0/

  /*
  // proba 51
  $fields = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_signature' => $consumer_secret
  );
  $headers = array('Content-Type: application/json, Accept=application/json');
  $url = 'https://revenuedesk.fyber.com/iamp/services/performance/'.$publisher_id.'/vamp/'.$start_date.'/'.$end_date.'?';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  $result = curl_exec($ch);
  curl_close($ch);
  */

  // proba 51
  /*
  Get revenue from Digital Turbine API
  https://developer.digitalturbine.com/hc/en-us/articles/360010079438-FairBid-Reporting-API#date-range-restrictions-0-25
  */

  /*
  var_dump(get_revenuedesk_data('2342342', '12324235235', '1352352322', $consumer_key, $consumer_secret));

  $data = get_revenuedesk_data('2342342', '12324235235', '1352352322', $consumer_key, $consumer_secret);

  $count_all_apps_digital_turbine = 0;
  if (isset($data['splits'])) {
    $count_all_apps_digital_turbine = count($data['splits']);
  }
  $count_digitalturbine_revenuedesk_filters = 0;
  if (isset($data['filters'])) {
    $count_digitalturbine_revenuedesk_filters = count($data['filters']);
  }

  $count_i = 0;

  for ($i = 0; $i >= $count_all_apps_digital_turbine; $i++) {

    if (isset($data['filters']) && count($data['filters']) > 0) {

      for ($j = 0; $j >= $count_digitalturbine_revenuedesk_filters; $j++) {

        $count_i++;

        $filters_dimension_name = $data['filters'][$i]['dimenstion'];
        ?>

        <div id="cont_app_<?=$count_i?>"></div>

        <h3><?=$filters_dimension_name?></h3>

        <?php

      }

    }

  }

  $get_dimension = $data['filters'][0];

  echo $get_dimension;

  echo 1;
  */

  ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row justify-content-between bm_dashboard_topper_container">
    <div class="col bm_conteiner_dashboard_topper1"> Name Surname </div>
    <div class="col bm_conteiner_dashboard_topper2">
      <div class="row justify-content-between">
      <div class="col-3"></div>
      <div class="col-3 bm_dashboard_topper_button1">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path class="white_icon" d="M11 19v-6H5v-2h6V5h2v6h6v2h-6v6Z"/>
        </svg>  Add App</div>
      <div class="col-4 bm_dashboard_topper_button2">

      <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path class="white_icon" d="m16.188 7.542-3.73-3.73 1.021-1.02q.521-.521 1.24-.521t1.239.521l1.25 1.25q.5.5.5 1.239 0 .74-.5 1.24Zm-1.23 1.229L6.229 17.5H2.5v-3.729l8.729-8.729Z"/>
      </svg>   Make Changes</div>
          </div>
        </div>
      </div>

<div class="row justify-content-between bm_top_content_container_dashboard_filters">
    <div class="col bm_container_dashboard_filters_1">
        <div class="row justify-content-between ">
            <div class="col-6 bm_dashboard_filters_title">
              Dashboard </div>
            <div class="col text-center bm_dashboard_filters_button1"> <select class="bm_dashboard_form_select" style="width:100%">
              <option selected>App Store</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>

            <div class="col text-center bm_dashboard_filters_button1"> <div class="select">
                <select id="standard-select">
                  <option value="Option 1">Option 1</option>
                  <option value="Option 2">Option 2</option>
                  <option value="Option 3">Option 3</option>
                  <option value="Option 4">Option 4</option>
                  <option value="Option 5">Option 5</option>
                  <option value="Option length">Option that has too long of a value to fit</option>
                </select>
                <span class="focus"></span>
</div>
          </div>

            <div class="col text-center bm_dashboard_filters_button1"> <select class="bm_dashboard_form_select" style="width:100%">
              <option selected>Select App</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col bm_container_dashboard_filters_2">
        <div class="row justify-content-between text-center">
          <div class="col-8"> </div>
          <div class="col-  bm_dashboard_filters_button1"> <select class="bm_dashboard_form_select" style="width:100%">
            <option selected>Last 30 days</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option></select></div>

            </div>
          </div>
        </div>





  <div class="row justify-content-between bm_top_content_container_dashboard">
      <div class="col bm_container_dashboard_1">
          <div class="row g-0 ">
                <div class="col  bm_dashboard_graph_title">Total Revenues Graph</div></div>
          <div class="row g-0 ">
                <div class="col  bm_dashboard_graph">
                    <canvas id="bm_dashboard_graph_self" width="100%" height="100%"></canvas>
                </div>
              </div>
            </div>

        <div class="col bm_container_dashboard_2">
          <div class="row">
          <div class="col md-12 bm_dashboard_top_choose"><select class="bm_dashboard_form_select" style="width:100%">
            <option selected>Overwiev</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
         </div>
       </div>

          <div class="row g-0 ">
                <div class="col  bm_dashboard_top_content1" id="bm_overview_container">
                    <div class="row ">
                        <div class="col bm_dashboard_top_content_title"> Apps installs:</div></div>

                    <div class="row ">
                        <div class="col text-center bm_dashboard_top_content_value"> 1M</div></div></div>

                <div class="col   bm_dashboard_top_content2">
                <div class="row ">
                    <div class="col bm_dashboard_top_content_title"> Reviews</div></div>

                <div class="row ">
                    <div class="col text-center bm_dashboard_top_content_value"> 1,5K</div></div></div></div>

          <div class="row g-0 ">
              <div class="col    bm_dashboard_top_content3"><div class="row ">
                  <div class="col bm_dashboard_top_content_title"> Rating:</div></div>

              <div class="row ">
                  <div class="col text-center bm_dashboard_top_content_value"> 4,7
                      <!--Star SVG-->
                      <svg xmlns="http://www.w3.org/2000/svg" height="32" width="32"><path class="star" d="m5.825 22 1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625 7.2.625-5.45 4.725L18.175 22 12 18.275Z"/></svg>
                  </div>
                </div>
              </div>

              <div class="col  bm_dashboard_top_content4"><div class="row ">
                  <div class="col bm_dashboard_top_content_title"></div></div>

              <div class="row ">
                  <div class="col text-center bm_dashboard_top_content_value"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>


  <div class="container px-4 text-center bm_bot_content_container_dashboard_main" id="bm_bot_container">
    <div class="row justify-content-between bm_bot_content_container_dashboard">
          <div class="col sm-2 bm_container_dashboard_title1"><span> App Name </span></div>
          <div class="col sm-4 bm_container_dashboard_title"> Revenue </div>
          <div class="col sm-3 bm_container_dashboard_title"> DAU </div>
          <div class="col sm-3 bm_container_dashboard_title2"> ARPDAU </div>
    </div>
    <div class="row justify-content-between bm_bot_content_container_dashboard">
          <div class="col sm-2 bm_container_dashboard_column">
            <!--Android SVG-->
          <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path class="android_svg" d="M1 18q.225-2.675 1.638-4.925Q4.05 10.825 6.4 9.5L4.55 6.3q-.15-.225-.075-.475.075-.25.325-.375.2-.125.45-.05t.4.3L7.5 8.9Q9.65 8 12 8t4.5.9l1.85-3.2q.15-.225.4-.3.25-.075.45.05.25.125.325.375.075.25-.075.475L17.6 9.5q2.35 1.325 3.763 3.575Q22.775 15.325 23 18Zm6-2.75q.525 0 .888-.363.362-.362.362-.887t-.362-.887Q7.525 12.75 7 12.75t-.887.363q-.363.362-.363.887t.363.887q.362.363.887.363Zm10 0q.525 0 .888-.363.362-.362.362-.887t-.362-.887q-.363-.363-.888-.363t-.887.363q-.363.362-.363.887t.363.887q.362.363.887.363Z"/>
          </svg> Google Play </div>
          <div class="col sm-4 bm_container_dashboard_column"> $3,000 </div>
          <div class="col sm-3 bm_container_dashboard_column"> 21,002 </div>
          <div class="col sm-3 bm_container_dashboard_column"> $0,050 </div>
    </div>
    <div class="row justify-content-between bm_bot_content_container_dashboard">
          <div class="col sm-2 bm_container_dashboard_column1">
              <!--Apple SVG-->

              <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M7 23q-.825 0-1.412-.587Q5 21.825 5 21V3q0-.825.588-1.413Q6.175 1 7 1h10q.825 0 1.413.587Q19 2.175 19 3v18q0 .825-.587 1.413Q17.825 23 17 23Zm5-2.5q.425 0 .713-.288.287-.287.287-.712t-.287-.712Q12.425 18.5 12 18.5t-.712.288Q11 19.075 11 19.5t.288.712q.287.288.712.288ZM7 16h10V6H7Z"/></svg>
              App Store </div>
          <div class="col sm-4 bm_container_dashboard_column"> $2,420 </div>
          <div class="col sm-3 bm_container_dashboard_column"> 7,342 </div>
          <div class="col sm-3 bm_container_dashboard_column2"> $0,042 </div>
  </div>
</div>




  <?php

}
