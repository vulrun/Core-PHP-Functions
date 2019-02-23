<?php
function cURLit($url, $options = array(), $output = 'body') {
	$_method = 'GET';
	$headers = isset($options['headers']) ? $options['headers'] : array();

	if( isset($options['json']) ){
		$headers[] = 'Content-Type: application/json';
		$body = is_array($options['json']) ? json_encode($options['json']) : $options['json'] ;
		$_method = 'POST';
	}
	elseif( isset($options['body']) ){
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$body = is_array($options['body']) ? http_build_query($options['body']) : $options['body'] ;
		$_method = 'POST';
	}

	!isset($options['method']) && $options['method'] = $_method;

	$curlOptions = array(
		CURLOPT_CUSTOMREQUEST  => $options['method'],
		CURLOPT_URL            => $url,
		CURLOPT_HEADER         => true,
		CURLINFO_HEADER_OUT    => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_VERBOSE        => true,
		CURLOPT_MAXREDIRS      => 10,
		CURLOPT_ENCODING       => '',
		CURLOPT_AUTOREFERER    => true,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_TIMEOUT        => 30,
		CURLOPT_HTTPHEADER     => $headers,
	);

	isset($body)                  &&  $curlOptions[CURLOPT_POSTFIELDS]   = $body;
	isset($options['proxy_addr']) &&  $curlOptions[CURLOPT_PROXY]        = $options['proxy_addr'];
	isset($options['proxy_auth']) &&  $curlOptions[CURLOPT_PROXYUSERPWD] = $options['proxy_auth'];
	isset($options['basic_auth']) &&  $curlOptions[CURLOPT_USERPWD]      = $options['basic_auth'];
	isset($options['user_agent']) &&  $curlOptions[CURLOPT_USERAGENT]    = $options['user_agent'];


	$result   = array('options' => $options);
	$ch       = curl_init();
	curl_setopt_array($ch, $curlOptions);
	$response = curl_exec($ch);

	$result['error']   = ($response === false) ? sprintf('ERROR: %d - %s.', curl_errno($ch), curl_error($ch)) : null ;
	$result['request'] = curl_getinfo($ch);
	$headerSize        = (int)    $result['request']['header_size'];
	$headers           = (string) substr($response, 0, $headerSize);
	$body              = (string) substr($response, $headerSize);
	curl_close($ch);


	$result['response']    = $response;
	$result['header']      = trim($headers);
	$result['body']        = trim($body);
	$result['json_decode'] = json_decode($body);

	if( json_last_error() != JSON_ERROR_NONE ){
		$result['json_decode'] = 'ERROR: Response received is not JSON or can\'t be decoded';
	}

	if( $response !== false && array_key_exists($output, $result) ){
		return $result[ $output ];
	}

	return $result;
}
