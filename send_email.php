<?php
function send_email($to, $subject, $body = '', $html = true, $headers = array() ){
	if( $html ){
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type:text/html;charset=UTF-8';
	}

	$headers[] = 'From: Anonymous <anonymous@google.com>';

	return mail( $to, $subject, $body, implode("\r\n", $headers) );
}
