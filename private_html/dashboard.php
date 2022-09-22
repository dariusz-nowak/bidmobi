<?php
# Detect localhost
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $root_path = $_SERVER['DOCUMENT_ROOT']."/platform-bidmobi/public_html";
} else {
  $root_path = $_SERVER['DOCUMENT_ROOT'];
}

include($root_path.'/root/secure/header/header.php');

include($root_path.'/root/dt/handler.php');
include($root_path.'/root/dt/helpers.php');

$bt = parse_output(dt_range_info_request(prep_with_range_all(1661983200,1662588000)));
$bt->agrigate_per_app();
/*
var_dump(parse_output_array(dt_range_info_request_array(prep_with_range_day_to_day(1661983200,1662588000))));
*/
?>

<div class="col py-3">
	<div id="load-container">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <div class="row justify-content-between bm_dashboard_topper_container">
      <div class="col bm_conteiner_dashboard_topper1"> Name Surname </div>
      <div class="col bm_conteiner_dashboard_topper2">
        <div class="row justify-content-between">
        <div class="col-3"></div>
        <div class="col-3 bm_dashboard_topper_button1">
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

    </div></div></div></div>

            <div class="row justify-content-between bm_top_content_container_dashboard_filters">
                <div class="col bm_container_dashboard_filters_1">
                    <div class="row justify-content-between ">
                        <div class="col-5 bm_dashboard_filters_title">
                          Dashboard </div>
                          <div class="col-2 bm_dashboard_filters_select"> <select class="selectpicker" data-style="btn-primary" data-width="170%">
                            <option id="filters_7days">Last 7 days</option>
                            <option id="filters_30days">Last 30 days</option>
                            <option id="filters_90days">Last 3 months</option>
                          </select>

                        </div>

                        <div class="col-2 bm_dashboard_filters_select"> <select class="selectpicker" data-style="btn-primary" data-width="170%" >
                          <option>Reviews</option>
                          <option>Ketchup</option>
                          <option>Relish</option>
                        </select>

                      </div>
                      <div class="col-2 bm_dashboard_filters_select"> <select class="selectpicker" data-style="btn-primary" data-width="170%">
                        <option>Select app</option>
                        <option>Ketchup</option>
                        <option>Relish</option>
                      </select>

                    </div>
                  </div>
                </div>

                  <div class="col bm_container_dashboard_filters_2">
                    <div class="row justify-content-between text-center">
                      <div class="col-8"> </div>
                      <div class="col-4  bm_dashboard_filters_button1">   <div class="bm_dashboard_filters_select"> <select class="selectpicker" data-style="btn-primary" data-width="140%">
                          <option id="overview_7days">Last 7 days</option>
                          <option id="overview_30days">Last 30 days</option>
                          <option id="overview_90days">Last 3 months</option>
                        </select>

                      </div>

            </div> </div></div>






    <div class="row justify-content-between bm_top_content_container_dashboard">

      <div class="col bm_container_dashboard_1">
        <div class="row g-0">
          <div class="col  bm_dashboard_graph_title">Total Revenues Graph</div>
        </div>
        <div class="row g-0">
          <div class="col bm_dashboard_graph" id="load_total_revenues_graph"></div>
        </div>
      </div>

      <div class="col bm_container_dashboard_2">
        <div class="row">
          <div class="col md-12 bm_dashboard_top_choose">
            <select class="bm_dashboard_form_select" style="width:100%">
              <option selected>Overwiev</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>

            <div class="row g-0 ">
                  <div class="col  bm_dashboard_top_content1">
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
                    </div></div></div>

                <div class="col  bm_dashboard_top_content4"><div class="row ">
                    <div class="col bm_dashboard_top_content_title"></div></div>

                <div class="row ">
                    <div class="col text-center bm_dashboard_top_content_value"> </div></div></div></div>
            </div>
          </div>
        </div>

    <div class="container px-4 text-center bm_bot_content_container_dashboard_main">
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
  </div>
</div>

<?php include($root_path.'/root/secure/footer/footer.php'); ?>
