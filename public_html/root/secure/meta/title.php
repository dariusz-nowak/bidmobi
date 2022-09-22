<?php
$get_pre_meta_title = explode('?', $_SERVER['REQUEST_URI']);
$get_meta_title = explode('/', $get_pre_meta_title[0]);

$make_meta_title = '';

if (substr_count($_SERVER['REQUEST_URI'], '/') == 5) {

  $make_meta_title = trim(ucfirst($get_meta_title[4]) .' - '. ucfirst($get_meta_title[5]));

} elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 4) {

  $make_meta_title = trim(ucfirst($get_meta_title[4]));

} elseif (substr_count($_SERVER['REQUEST_URI'], '/') == 3) {

  $make_meta_title = trim(ucfirst($get_meta_title[3]));

}

if ($make_meta_title == '') {
  $make_meta_title = 'Platform';
}

echo $make_meta_title .' - BidMobi';
