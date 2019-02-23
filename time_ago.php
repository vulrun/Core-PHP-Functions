<?php
function time_ago( $time ) {
	$time = time() - $time;
	$time = max(1, $time);
	$periods = array (
		'decade' => 60 * 60 * 24 * 30 * 12 * 10,
		'year'   => 60 * 60 * 24 * 30 * 12,
		'month'  => 60 * 60 * 24 * 30,
		'week'   => 60 * 60 * 24 * 7,
		'day'    => 60 * 60 * 24,
		'hr'     => 60 * 60,
		'min'    => 60,
		'sec'    => 1,
	);

	foreach ($periods as $unit => $seconds) {
		if ($time < $seconds) {
			continue;
		}

		$number = floor($time / $seconds);
		$plural = ($number > 1) ? 's ago' : ' ago';
		return $number.' '.$unit.$plural;
	}
}
