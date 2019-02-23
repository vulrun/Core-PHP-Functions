<?php
function inBytes($ini_v) {
	$ini_v = trim($ini_v);
	$units = array('K' => 1<<10, 'M' => 1<<20, 'G' => 1<<30);
	return intval($ini_v) * ($units[strtoupper( substr($ini_v, -1) )] ? : 1);
}
