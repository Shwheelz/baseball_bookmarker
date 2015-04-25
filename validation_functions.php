<?php
	// validate presence
	function has_presence($value){
		return isset($value) && $value !== "";
	}

	// validate minimum length
	function has_min_length($value, $min){
		return strlen($value) >= $min;
	}

	// validate maximum length
	function has_max_length($value, $max){
		return strlen($value) <= $max;
	}

	function form_errors($errors=array()){
		$output = "";

		if (!empty($errors)){
			echo "<div class=\"error\">";
			echo "Please fix the following errors:";
			echo "<ul>";
			foreach($errors as $key => $error) {
				echo "<li>{$error}</li>";
			}
			echo "</ul>";
			echo "</div>";
		}

		return $output;
	}
?>
