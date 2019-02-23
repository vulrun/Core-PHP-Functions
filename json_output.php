<?php
function output($flag, $response, $extra = array()) {
	header('Content-Type: application/json');
	$data = array('flag' => (bool) $flag, 'response' => $response);
	exit(json_encode($data + $extra, JSON_PRETTY_PRINT));
}
