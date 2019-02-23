<?php
function randid($len = 8, $pattern = 'a0'){
	$i = 0;
	$str = '';
	$charset = '';
	if( preg_match('/[A-Z]/', $pattern) ){
		$charset .= 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
	}
	if( preg_match('/[a-z]/', $pattern) ){
		$charset .= 'abcdefghijkmnopqrstuvwxyz';
	}
	if( preg_match('/\d/', $pattern) ){
		$charset .= '0123456789';
	}

	while( $i < $len ){
		$str .= str_shuffle($charset)[0];
		$i++;
	}
	return $str;
}
