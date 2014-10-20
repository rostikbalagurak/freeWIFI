<?php 

class Utils {
	
	public static function getQueryCondition($key, $value, $cond, $is_string){
		if($is_string){
			return $key . ' ' . $cond . ' "' . $value . '"';
		} else {
			return $key . ' ' . $cond . ' ' . $value;
		}
	}
	
}