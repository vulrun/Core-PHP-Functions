<?php
function formatFileSize($bytes, $round = 2) {
	if($bytes < 0) return 'Too Large';
	$units = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
	$bytes = max($bytes, 0);
	$power = floor(($bytes ? log($bytes) : 0) / log(1024) );
	$power = min($power, count($units) - 1);
	$bytes /= pow(1024, $power);
	return round($bytes, $round).' '.$units[$power];
}
