<?php
function hr($return = false){
  if ($return){
    return "<hr>\n";
  } else {
    echo "<hr>\n";
  }
}

function br($return = false){
  if ($return){
    return "<br>\n";
  } else {
    echo "<br>\n";
  }

}

function dump($var, $return = false){
  if (is_array($var)){
    $out = print_r($var, true);
  } else if (is_object($var)) {
    $out = var_export($var, true);
  } else {
    $out = $var;
  }

  if ($return){
    return "\n<pre>$out</pre>\n";
  } else {
    echo "\n<pre>$out</pre>\n";
  }
}

function getCurrentDateTime(){
  return date("Y-m-d H:i:s");
}

function encryptPassword($password){
  global $config;
  return md5($password . $config['salt']);
}

function login($studentNumber, $password){
	$url = "http://"."172.17.0.1".":8080/student/login?studentNumber="."$studentNumber"."&password="."$password";

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	$r = (json_decode($resp, true));

	$tmp = $r['result'];
	if($r['status'] == 200 ){
	 return $tmp['session'];
	}
}

function authenticate($studentNumber, $session){
  	$url = "http://"."172.17.0.1".":8080/authenticate?studentNumber="."$studentNumber"."&session="."$session";
  	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	$r = (json_decode($resp, true));
	if($r['status'] == 200 ){
	 return true;
	}else{
	  return false;
	}
}