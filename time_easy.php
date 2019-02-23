<?php
function time_easy( $time ) {
	$time = is_numeric($time) ? $time : strtotime($time);
	$time = max(0, $time);

	$curr_Y = date('Y');
	$this_Y = date('Y', $time);
	$curr_M = date('M');
	$this_M = date('M', $time);
	$curr_d = date('d');
	$this_d = date('d', $time);
	$curr_H = date('H');
	$this_H = date('H', $time);

	if( $curr_Y == $this_Y ) {
		if( $curr_M == $this_M ) {
			if( $curr_d == $this_d ) {
				if( $curr_H == $this_H ) {
					return ago_time($time);
				}
				else {
					return date('h:i A', $time);
				}
			}
			else {
				return date('d M', $time);
			}
		}
		else {
			return date('d M', $time);
		}
	}
	else {
		return date('d M, Y', $time);
	}
}
