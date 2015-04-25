<!DOCTYPE html>
<html>
	<head>
		<title>Form Processing</title>
	</head>

	<body>

		<pre>
			<?php print_r($_POST); ?>
		</pre>

		<br />
		<?php
			if (isset($_POST['submit'])) {

				echo "Form was submitted successfully\n";
					
				$fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
				$lname = isset($_POST["fname"]) ? $_POST["lname"] : "";
				$position = isset($_POST["fname"]) ? $_POST["position"] : "";
				$team = isset($_POST["fname"]) ? $_POST["team"] : "";
				$number = isset($_POST["fname"]) ? $_POST["number"] : "";	
			}
		?>
	</body>
</html>