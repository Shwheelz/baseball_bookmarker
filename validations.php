<!DOCTYPE html>

<html>
	<head>
		<title> </title>
	</head>
	<body>
		<?php
			// validate presence
			if (!isset($value) || empty($value)){
				echo "{$value} is not set <br />";
			}

			// validate minimum length
			$min = 3;
			if (strlen($value) < $min) {
				echo "{$value} is too short <br />";
			}

			// validate maximum length
			$max = 24;
			if (strlen($value) > $max) {
				echo "{$value} is too long <br />";
			}

		?>
	</body>
</html>