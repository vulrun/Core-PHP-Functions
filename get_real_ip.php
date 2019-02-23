<?php
function get_real_ip() {
	if( isset( $_SERVER['HTTP_CLIENT_IP']         ) ) return $_SERVER['HTTP_CLIENT_IP'];
	if( isset( $_SERVER['HTTP_X_FORWARDED_FOR']   ) ) return $_SERVER['HTTP_X_FORWARDED_FOR'];
	if( isset( $_SERVER['HTTP_X_FORWARDED']       ) ) return $_SERVER['HTTP_X_FORWARDED'];
	if( isset( $_SERVER['HTTP_FORWARDED_FOR']     ) ) return $_SERVER['HTTP_FORWARDED_FOR'];
	if( isset( $_SERVER['HTTP_FORWARDED']         ) ) return $_SERVER['HTTP_FORWARDED'];
	if( isset( $_SERVER['REMOTE_ADDR']            ) ) return $_SERVER['REMOTE_ADDR'];
	return '8.8.8.8';
}
