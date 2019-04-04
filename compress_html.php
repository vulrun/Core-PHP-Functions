<?php
function compress_html($html) {
	$search = array(
		'/[\n\t\r]/',        // replace end of line or tab by a space
		'/\>[^\S ]+/s',      // strip whitespaces after tags, except space
		'/[^\S ]+\</s',      // strip whitespaces before tags, except space
		'/(\s)+/s',          // shorten multiple whitespace sequences
		'/<!--(.*)-->/Uis',  // Remove HTML comments
	);

	$replace = array(
		' ',
		'>',
		'<',
		'\\1',
		'',
	);

	return preg_replace($search, $replace, $html);
}
