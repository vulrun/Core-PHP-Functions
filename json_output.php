<?php
function json_output($flag, $response = '', $xtra = array()){
	header('content-type: application/json');
	$data = is_array($flag) ? $flag : array('flag' => (bool) $flag, 'response' => $response);
	$xtra = is_array($xtra) ? $xtra : array($xtra);
	exit( json_encode($data + $xtra, JSON_PRETTY_PRINT) );
}
