<?php

class DateTimeParser {

	/*
		Converts date from format DD.MM.YYYY to YYYY-MM-DD. Returns null if original date form is invalid.
	*/
	public function date_to_sql_date($date) {
		if (!DateValidator::date_is_valid($date)) {
			return null;
		}
		$split = explode(".", $date);
		return $split[2] . '-' . $split[1] . '-' . $split[0]; 
	}

	public function sql_date_to_date($sql_date) {
		$split = explode("-", $sql_date);
		return $split[2] . '.' . $split[1] . "." . $split[0];
	}

	public function sql_time_to_time($sql_time) {
		$split = explode(":", $sql_time);
		return $split[0] . ':' . $split[1];
	}

	/*
		Converts time from format HH:MM to HH:MM:SS. Returns null if original time form is invalid.
	*/
	public function time_to_sql_time($time) {
		if (!DateValidator::time_is_valid($time)) {
			return null;
		}
		return $time . ':00';
	}
}