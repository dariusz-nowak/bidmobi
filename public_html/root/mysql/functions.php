<?php
function executeSql($sqlFileToExecute) {
	global $db;
  $templine = '';
	$lines    = file($sqlFileToExecute);
	$impError = 0;
	foreach($lines as $line) {
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;
		$templine .= $line;
		if (substr(trim($line), -1, 1) == ';') {
			if (!$db->Query($templine)) {
				$impError = 1;
			}
			$templine = '';
		}
	}
  if ($impError == 0) {
    return 'Script is executed succesfully!';
  } else {
    return 'An error occured during SQL importing!';
  }
}

function remove_http($url) {
  $disallowed = array('http://', 'https://');
  foreach($disallowed as $d) {
    if (strpos($url, $d) === 0) {
      return str_replace($d, '', $url);
    }
  }
  return $url;
}

function convert_to_a_z($text) {
	$text = str_replace("ʹ", '`', str_replace("'", '`', transliterator_transliterate('Any-Latin;Latin-ASCII;', preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($text)))));
	$text = str_replace("ʹ", '`', str_replace("'", '`', $text));
	return $text;
}

function getOperationSystem($user_agent) {
	$os_platform = "Unknown OS Platform";
	$os_array = array(
		'/windows nt 10/i'     =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		'/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/iphone/i'             =>  'iPhone',
		'/ipod/i'               =>  'iPod',
		'/ipad/i'               =>  'iPad',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'Mobile',
		'/com.zareklamy.app/i'  =>  'Paidwork iOS version'
  );
	foreach ($os_array as $regex => $value) {
	  if (preg_match($regex, $user_agent)) {
			if ($regex == '/com.zareklamy.app/i') {
				$os_platform = $value .' '.preg_replace('/[^0-9.]+/', '', explode('(', $user_agent)[0]);
			} else {
				$os_platform = $value;
			}
	  }
	}
	return $os_platform;
}

function getBrowser($user_agent) {
  $browser = "Unknown Browser";
  $browser_array = array(
		'/msie/i'               => 'Internet Explorer',
		'/firefox/i'            => 'Firefox',
		'/safari/i'             => 'Safari',
		'/chrome/i'             => 'Chrome',
		'/edge/i'               => 'Edge',
		'/opera/i'              => 'Opera',
		'/netscape/i'           => 'Netscape',
		'/maxthon/i'            => 'Maxthon',
		'/konqueror/i'          => 'Konqueror',
		'/mobile/i'             => 'Handheld Browser',
		'/com.zareklamy.app/i'  => 'iOS'
  );
  foreach ($browser_array as $regex => $value) {
		if (preg_match($regex, $user_agent)) {
			if ($regex == '/com.zareklamy.app/i') {
				$browser = $value .' '.explode('iOS', explode(')', $user_agent)[0])[1];
			} else {
				$browser = $value;
			}
		}
	}
  return $browser;
}

function isMobile() {
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function redirect($location) {
  $hs = headers_sent();
  if ($hs === false) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Location: '.$location);
  } elseif ($hs == true) {
    echo "<script>document.location.href='".htmlspecialchars($location)."'</script>";
  }
  exit(0);
}

function website_title($url) {
  $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8');
  $html = curl_exec($ch);
  curl_close($ch);
  $dom  = new DOMDocument;
  @$dom->loadHTML($html);
  $title = $dom->getElementsByTagName('title')->item('0')->nodeValue;
  return $title;
}

function truncate($str, $length, $trailing='...') {
	if (function_exists('mb_strlen') && function_exists('mb_substr')) {
		$length-=mb_strlen($trailing);
		if (mb_strlen($str)> $length) {
			return mb_substr($str,0,$length).$trailing;
		} else {
			return $str;
		}
	} else {
		return $str;
	}
}

function randStrGen($len) {
	$result = "";
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$charArray = str_split($chars);
	for ($i = 0; $i < $len; $i++) {
		$randItem = array_rand($charArray);
		$result .= "".$charArray[$randItem];
	}
	return $result;
}

function get_data($url, $timeout = 15, $header = array(), $options = array()) {
	if (!function_exists('curl_init')) {
    return file_get_contents($url);
  } elseif (!function_exists('file_get_contents')) {
    return '';
  }
	if (empty($options)) {
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
			CURLOPT_TIMEOUT => $timeout
		);
	}
	if (empty($header)) {
		$header = array(
			"Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*\/*;q=0.5",
			"Accept-Language: en-us,en;q=0.5",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
			"Cache-Control: must-revalidate, max-age=0",
			"Connection: keep-alive",
			"Keep-Alive: 300",
			"Pragma: public"
		);
	}
	if ($header != 'NO_HEADER') {
		$options[CURLOPT_HTTPHEADER] = $header;
	}
	$ch = curl_init();
	curl_setopt_array($ch, $options);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function reverse_url($url) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_HEADER,1);
	curl_setopt($ch,CURLOPT_NOBODY,1);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_TIMEOUT,4);
	curl_setopt($ch,CURLOPT_IPRESOLVE,CURL_IPRESOLVE_V4);
	$result = curl_exec($ch);
	if (!empty($result)) {
		return $result;
	} else {
		return null;
	}
}

function lang_rep($text, $inputs = array()) {
	if (empty($inputs) || !is_array($inputs)) return $text;
	foreach ($inputs as $search => $replace) {
		$text = str_replace($search, $replace, $text);
	}
	return $text;
}

function countryToContinent($country) {
	$continent = '';
	switch ($country) {
		case 'DE':
		case 'GG':
		case 'VA':
		case 'HU':
		case 'IS':
		case 'IE':
		case 'IM':
		case 'IT':
		case 'JE':
		case 'LV':
		case 'LI':
		case 'LT':
		case 'LU':
		case 'MK':
		case 'MT':
		case 'MD':
		case 'MC':
		case 'ME':
		case 'NL':
		case 'NO':
		case 'RO':
		case 'RU':
		case 'RS':
		case 'SK':
		case 'SI':
		case 'ES':
		case 'SJ':
		case 'SE':
		case 'CH':
		case 'UA':
		case 'GB':
		case 'GI':
		case 'GR':
		case 'AX':
		case 'AL':
		case 'AD':
		case 'AT':
		case 'BA':
		case 'BY':
		case 'BE':
		case 'BG':
		case 'CZ':
		case 'DK':
		case 'EE':
		case 'HR':
		case 'FI':
		case 'FR':
		case 'FO':
		case 'PL':
		case 'PT':
		case 'SM':
		case 'XK':
			$continent = 'EU';
			break;
		case 'GH':
		case 'DZ':
		case 'AO':
		case 'BJ':
		case 'BW':
		case 'BF':
		case 'BI':
		case 'CM':
		case 'CV':
		case 'CF':
		case 'TD':
		case 'KM':
		case 'CD':
		case 'CG':
		case 'CI':
		case 'DJ':
		case 'EG':
		case 'GQ':
		case 'SS':
		case 'ER':
		case 'ET':
		case 'GA':
		case 'GM':
		case 'GN':
		case 'GW':
		case 'KE':
		case 'LS':
		case 'LR':
		case 'LY':
		case 'MG':
		case 'MW':
		case 'ML':
		case 'MR':
		case 'MU':
		case 'YT':
		case 'MA':
		case 'MZ':
		case 'NA':
		case 'NE':
		case 'NG':
		case 'RE':
		case 'RW':
		case 'SH':
		case 'ST':
		case 'SN':
		case 'SC':
		case 'SL':
		case 'SO':
		case 'ZA':
		case 'SD':
		case 'SZ':
		case 'TZ':
		case 'TG':
		case 'TN':
		case 'UG':
		case 'EH':
		case 'ZM':
		case 'ZW':
			$continent = 'AF';
			break;
		case 'AF':
		case 'AM':
		case 'AZ':
		case 'BH':
		case 'BD':
		case 'BT':
		case 'IO':
		case 'BN':
		case 'KH':
		case 'CN':
		case 'CX':
		case 'CC':
		case 'CY':
		case 'GE':
		case 'HK':
		case 'IN':
		case 'ID':
		case 'IR':
		case 'IQ':
		case 'IL':
		case 'JP':
		case 'JO':
		case 'KZ':
		case 'KP':
		case 'KR':
		case 'KW':
		case 'KG':
		case 'LA':
		case 'LB':
		case 'MO':
		case 'MY':
		case 'MV':
		case 'MN':
		case 'MM':
		case 'NP':
		case 'OM':
		case 'PK':
		case 'PS':
		case 'PH':
		case 'QA':
		case 'SA':
		case 'SG':
		case 'LK':
		case 'SY':
		case 'TW':
		case 'TJ':
		case 'TH':
		case 'TL':
		case 'TR':
		case 'TM':
		case 'AE':
		case 'UZ':
		case 'VN':
		case 'YE':
			$continent = 'AS';
			break;
		case 'AU':
		case 'AS':
		case 'CK':
		case 'FJ':
		case 'PF':
		case 'GU':
		case 'KI':
		case 'MH':
		case 'FM':
		case 'NR':
		case 'NC':
		case 'NZ':
		case 'NU':
		case 'NF':
		case 'MP':
		case 'PW':
		case 'PG':
		case 'PN':
		case 'WS':
		case 'SB':
		case 'TK':
		case 'TO':
		case 'SX':
		case 'TV':
		case 'UM':
		case 'VU':
		case 'WF':
		case 'BQ':
			$continent = 'OC';
			break;
		case 'AQ':
		case 'BV':
		case 'TF':
		case 'HM':
		case 'GS':
			$continent = 'AN';
			break;
		case 'AI':
		case 'AW':
		case 'AG':
		case 'BS':
		case 'BB':
		case 'BZ':
		case 'BM':
		case 'CA':
		case 'KY':
		case 'VG':
		case 'CR':
		case 'CU':
		case 'DM':
		case 'DO':
		case 'SV':
		case 'GL':
		case 'GD':
		case 'GP':
		case 'GT':
		case 'HT':
		case 'HN':
		case 'JM':
		case 'MQ':
		case 'MX':
		case 'MS':
		case 'NI':
		case 'PA':
		case 'PR':
		case 'BL':
		case 'KN':
		case 'LC':
		case 'MF':
		case 'PM':
		case 'VC':
		case 'AN':
		case 'TT':
		case 'TC':
		case 'US':
		case 'VI':
			$continent = 'NA';
			break;
		case 'AR':
		case 'BO':
		case 'CL':
		case 'CO':
		case 'BR':
		case 'EC':
		case 'FK':
		case 'GF':
		case 'GY':
		case 'PY':
		case 'PE':
		case 'SR':
		case 'UY':
		case 'VE':
		case 'CW':
			$continent = 'SA';
			break;
	}
	return $continent;
}

function is_bot($user_agent) {
  return preg_match('/(abot|dbot|ebot|hbot|kbot|lbot|mbot|nbot|obot|pbot|rbot|sbot|tbot|vbot|ybot|zbot|bot\.|bot\/|_bot|\.bot|\/bot|\-bot|\:bot|\(bot|crawl|slurp|spider|seek|accoona|acoon|adressendeutschland|ah\-ha\.com|ahoy|altavista|ananzi|anthill|appie|arachnophilia|arale|araneo|aranha|architext|aretha|arks|asterias|atlocal|atn|atomz|augurfind|backrub|bannana_bot|baypup|bdfetch|big brother|biglotron|bjaaland|blackwidow|blaiz|blog|blo\.|bloodhound|boitho|booch|bradley|butterfly|calif|cassandra|ccubee|cfetch|charlotte|churl|cienciaficcion|cmc|collective|comagent|combine|computingsite|csci|curl|cusco|daumoa|deepindex|delorie|depspid|deweb|die blinde kuh|digger|ditto|dmoz|docomo|download express|dtaagent|dwcp|ebiness|ebingbong|e\-collector|ejupiter|emacs\-w3 search engine|esther|evliya celebi|ezresult|falcon|felix ide|ferret|fetchrover|fido|findlinks|fireball|fish search|fouineur|funnelweb|gazz|gcreep|genieknows|getterroboplus|geturl|glx|goforit|golem|grabber|grapnel|gralon|griffon|gromit|grub|gulliver|hamahakki|harvest|havindex|helix|heritrix|hku www octopus|homerweb|htdig|html index|html_analyzer|htmlgobble|hubater|hyper\-decontextualizer|ia_archiver|ibm_planetwide|ichiro|iconsurf|iltrovatore|image\.kapsi\.net|imagelock|incywincy|indexer|infobee|informant|ingrid|inktomisearch\.com|inspector web|intelliagent|internet shinchakubin|ip3000|iron33|israeli\-search|ivia|jack|jakarta|javabee|jetbot|jumpstation|katipo|kdd\-explorer|kilroy|knowledge|kototoi|kretrieve|labelgrabber|lachesis|larbin|legs|libwww|linkalarm|link validator|linkscan|lockon|lwp|lycos|magpie|mantraagent|mapoftheinternet|marvin\/|mattie|mediafox|mediapartners|mercator|merzscope|microsoft url control|minirank|miva|mj12|mnogosearch|moget|monster|moose|motor|multitext|muncher|muscatferret|mwd\.search|myweb|najdi|nameprotect|nationaldirectory|nazilla|ncsa beta|nec\-meshexplorer|nederland\.zoek|netcarta webmap engine|netmechanic|netresearchserver|netscoop|newscan\-online|nhse|nokia6682\/|nomad|noyona|nutch|nzexplorer|objectssearch|occam|omni|open text|openfind|openintelligencedata|orb search|osis\-project|pack rat|pageboy|pagebull|page_verifier|panscient|parasite|partnersite|patric|pear\.|pegasus|peregrinator|pgp key agent|phantom|phpdig|picosearch|piltdownman|pimptrain|pinpoint|pioneer|piranha|plumtreewebaccessor|pogodak|poirot|pompos|poppelsdorf|poppi|popular iconoclast|psycheclone|publisher|python|rambler|raven search|roach|road runner|roadhouse|robbie|robofox|robozilla|rules|salty|sbider|scooter|scoutjet|scrubby|search\.|searchprocess|semanticdiscovery|senrigan|sg\-scout|shai\'hulud|shark|shopwiki|sidewinder|sift|silk|simmany|site searcher|site valet|sitetech\-rover|skymob\.com|sleek|smartwit|sna\-|snappy|snooper|sohu|speedfind|sphere|sphider|spinner|spyder|steeler\/|suke|suntek|supersnooper|surfnomore|sven|sygol|szukacz|tach black widow|tarantula|templeton|\/teoma|t\-h\-u\-n\-d\-e\-r\-s\-t\-o\-n\-e|theophrastus|titan|titin|tkwww|toutatis|t\-rex|tutorgig|twiceler|twisted|ucsd|udmsearch|url check|updated|vagabondo|valkyrie|verticrawl|victoria|vision\-search|volcano|voyager\/|voyager\-hc|w3c_validator|w3m2|w3mir|walker|wallpaper|wanderer|wauuu|wavefire|web core|web hopper|web wombat|webbandit|webcatcher|webcopy|webfoot|weblayers|weblinker|weblog monitor|webmirror|webmonkey|webquest|webreaper|websitepulse|websnarf|webstolperer|webvac|webwalk|webwatch|webwombat|webzinger|wget|whizbang|whowhere|wild ferret|worldlight|wwwc|wwwster|xenu|xget|xift|xirq|yandex|yanga|yeti|yodao|zao\/|zippp|zyborg|\.\.\.\.)/i', $user_agent);
}

function html_minifier($buffer) {
  $search = array(
    '/\>[^\S ]+/s',
    '/[^\S ]+\</s',
    '/(\s)+/s',
    '/<!--(.|\s)*?-->/'
  );
  $replace = array(
    '>',
    '<',
    '\\1',
    ''
  );
  $buffer = preg_replace($search, $replace, $buffer);
  return $buffer;
}
// ob_start('html_minifier');

function js_minifier($buffer) {
  $search = array(
    '/\>[^\S ]+/s',
    '/[^\S ]+\</s',
    '/<!--(.|\s)*?-->/'
  );
  $replace = array(
    '>',
    '<',
    ''
  );
  $buffer = preg_replace($search, $replace, $buffer);
  return $buffer;
}
