<!DOCTYPE html>

<html>
	<head>
		<title>Validation Errors</title>
	</head>
	<body>
		<?php
			require_once('validation_functions.php');

			$errors = array();

			$lname = trim("Shane");
			if (!has_presence($lname)) {
				$errors['lname'] = "Last name can't be blank";
			}
		?>

		<?php echo form_errors($errors); ?>
	</body>
</html>