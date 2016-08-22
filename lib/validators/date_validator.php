<?php

class DateValidator {

	public static function date_is_valid($date) {
		$split = explode(".",$date);
		if (count($split) != 3) {
			return false;
		}
		return checkdate($split[1], $split[0], $split[2]);
	}

	public static function time_is_valid($time) {
		$split = explode(":", $time);
		if (count($split) != 2) {
			return false;
		}
		$hour = intval($split[0]);
		$minute = intval($split[1]);
		if (!is_int($hour) || !is_int($minute)) {
			return false;
		}
		if (!($hour >= 0 && $hour <= 24) || !($minute >= 0 && $minute <= 60)) {
			return false;
		}
		return true;
	}
}