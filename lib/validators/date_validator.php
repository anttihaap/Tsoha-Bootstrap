<?php

class DateValidator {

	public static function date_is_valid($date) {
		$split = explode(".",$date);
		if (count($split) != 3) {
			return false;
		}
		$day = $split[0];
		$month = $split[1];
		$year = $split[2];
		if (!ctype_digit($day) || !ctype_digit($month) || !ctype_digit($year)) {
			return false;
		}
		return checkdate($month, $day, $year);
	}

	public static function time_is_valid($time) {
		$split = explode(":", $time);
		if (count($split) != 2) {
			return false;
		}
		$hour = $split[0];
		$minute = $split[1];
		if (!ctype_digit($hour) || !ctype_digit($minute)) {
			return false;
		}
		if (!($hour >= 0 && $hour <= 24) || !($minute >= 0 && $minute <= 60)) {
			return false;
		}
		return true;
	}

	public static function is_greater($a_date, $a_time, $b_date, $b_time) {
		if (!date_is_valid($a_date) || !date_is_valid($b_date) || !time_is_valid($a_time) || !time_is_valid($b_time)) {
			return null;
		}

		$a_date_split = explode(".", $a_date);
		$b_date_split = explode(".", $b_date);

		$a_time_split = explode(":", $a_time);
		$b_time_split = explode(":", $b_time);

		$a_date_time = new DateTime($a_date_split[2] . "-" );
		return null;
	}
}