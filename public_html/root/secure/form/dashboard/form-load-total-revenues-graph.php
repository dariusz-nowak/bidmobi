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

	$select_date = $_POST['select_date'] ?? 3;

	function get_revenuedesk_data1($publisher_id, $consumer_key, $consumer_secret, $start_date, $end_date) {
    $fields = array(
      'consumer_key' => $consumer_key,
      'signature' => $consumer_secret
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
    return json_decode($result, true);
  }

	$get_user_keys = $db->QueryFetchArray("SELECT * FROM user_keys WHERE user_id = {$user['id']} LIMIT 1");

	$publisher_id = $get_user_keys['digital_turbine_publisher_id'];
	$consumer_key = $get_user_keys['digital_turbine_consumer_key'];
	$consumer_secret = $get_user_keys['digital_turbine_consumer_secret'];

	$start_date = time();

	// 7 days
	if ($select_date == 1) {
		$end_date = date('Y-m-d', strtotime('-7 days'));
	}

	// 30 days
	if ($select_date == 2) {
		$end_date = date('Y-m-d', strtotime('-30 days'));
	}

	// 3 months
	if ($select_date == 3) {
		$end_date = date('Y-m-d', strtotime('-3 months'));
	}

	$get_data = get_revenuedesk_data1($publisher_id, $consumer_key, $consumer_secret, $start_date, $end_date);

	$get_values = '';
	for ($i = 1; $i <= 91; $i++) {
		$get_values .= '0,';
	}

  if($get_data === null) {
    echo("No data to display");
  } else {
    foreach ($get_data as $value) {
      $get_values .= $get_data['revenue'].',';
    }
  }
	?>

	<div style="width:75%;">
	  <div id="chart"></div>
	</div>

	<script>
        var options = {
          series: [{
            name: "Desktops",
            data: [
							<?=$get_values?>
						]
          }],
            chart: {
            height: 150,
            type: 'line',
            zoom: {
              enabled: false
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'straight'
          },
          title: {
            text: 'Product Trends by Month',
            align: 'left'
          },
          grid: {
            row: {
              colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
              opacity: 0.1
            },
          },
          xaxis: {
            categories: [
              <?=$get_values?>
            ]
          }
        },

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
	    </script>
  <?php
}
