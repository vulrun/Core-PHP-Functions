<?php
function scan_dir($path, $opts = null, &$list = array() ){
	$files = scandir($path, stripos($opts, 'desc') !== false ? 1 : 0);
	$files = array_diff( $files, array('.', '..') );

	foreach($files as $file){
		$fullpath = "$path/$file";
		if( is_dir($fullpath) ){
			stripos($opts, 'skipDirs' ) === false && array_push($list, $fullpath);
			stripos($opts, 'recursive') !== false && scan_dir("$path/$file", $opts, $list);
		}
		else {
			stripos($opts, 'skipFiles') === false && array_push($list, $fullpath);
		}
	}

	if( stripos($opts, 'dirFirst') !== false ){
		$dirA = $filA = array();
		foreach ($list as $l) {
			is_dir(realpath($l)) ? array_push($dirA, $l) : array_push($filA, $l);
		}
		return array_merge($dirA, $filA);
	}
	return $list;
}
