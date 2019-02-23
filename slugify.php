<?php
function slugify($text, $sep = '-') {
	$text = preg_replace('~[^\pL\d]+~u', $sep, $text);      // replace non letter or digits by -
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);    // transliterate
	$text = preg_replace('~[^-\w]+~', $sep, $text);         // remove unwanted characters
	$text = trim($text, $sep);                              // trim
	$text = preg_replace("~$sep+~", $sep, $text);           // remove duplicate -
	$text = strtolower($text);                              // lowercase
	return empty($text) ? false : $text;
}
