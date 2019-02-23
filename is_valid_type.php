<?php
function is_valid_type($val, $ctype = ''){
	$type = is_array($ctype) ? $ctype : explode(',', $ctype);
	$valid = !empty($val);

	if( in_array('alpha', $type) ){
		$valid &= ctype_alpha($val);
	}
	if( in_array('numeric', $type) ){
		$valid &= is_numeric($val);
	}
	if( in_array('alphanumeric', $type) ){
		$valid &= ctype_alnum($val);
	}
	if( in_array('alphaspace', $type) ){
		$valid &= preg_match("/^[a-zA-Z\s]+$/", $val);
	}
	if( in_array('email', $type) ){
		$valid &= filter_var($val, FILTER_VALIDATE_EMAIL);
	}
	if( in_array('date', $type) ){
		$d = explode('/', $val);
		$valid &= preg_match("/^[0-9\/]+$/", $val) && @checkdate( $d[1], $d[0], $d[2] );
	}
	if( in_array('max10', $type) ){
		$valid &= ( strlen($val) > 0 && strlen($val) <= 10 );
	}
	if( in_array('len10', $type) ){
		$valid &= ( strlen($val) == 10 );
	}
	if( in_array('len4', $type) ){
		$valid &= ( strlen($val) == 4 );
	}
	if( in_array('enumYN', $type) ){
		$valid &= in_array( $val, ['y','n','Y','N'] );
	}
	if( in_array('gender', $type) ){
		$valid &= in_array( $val, ['m','f','o','M','F','O'] );
	}

	return $valid;
}
