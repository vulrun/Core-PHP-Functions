<?php
function encodeKey($str, $secret = 'SECRET_SALT') {
	$crypt = md5($secret);
	$str = rand(12345, 98765).$str.rand(12345, 98765);
	return bin2hex( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, $crypt, $str, MCRYPT_MODE_CBC, md5($crypt) ) );
}

function decodeKey($str, $secret = 'SECRET_SALT') {
	$crypt = md5($secret);
	$str = trim( htmlentities( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, $crypt, @hex2bin($str), MCRYPT_MODE_CBC, md5($crypt) ) ) );
	$str = substr($str, 5, -5);
	return $str;
}
