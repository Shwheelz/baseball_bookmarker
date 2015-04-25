<?php
	require_once("included_functions.php");
	require_once("validation_functions.php");

	$errors = array();
	$message = "";

	if (isset($_POST['submit'])) {
		// form was submitted
		$fname = trim($_POST["fname"]);
		$lname = trim($_POST["lname"]);
		$team = trim($_POST["team"]);
		$position = trim($_POST["position"]);
		$number = trim($_POST["number"]);	


		// Validations
		$fields_required = array("fname", "lname");
		foreach($fields_required as $field){
			$value = trim($_POST[$field]);
			if (!has_presence($value)){
				$errors[$field] = ucfirst($field) . " can't be blank";
			}
		}

		// enter information into the database
		if (empty($errors)){
			// Establish a database connection
			$dbhost = "localhost";
			$dbuser = "test";
			$dbpass = "password";
			$dbname = "baseball";
			$dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Test if connection occurred
			if(mysqli_connect_errno()) {
				die("Database connection failed: " . 
					mysqli_connect_error() .
					" (" . mysqli_connect_errno() . ")"
				);
			}

			// set values in database
			$query = "INSERT INTO player (";
			$query .= " fname, lname, team, position, number";
			$query .= ") VALUES (";
			$query .= " '{$fname}', '{$lname}', '{$team}', '{$position}', '{$number}'";
			$query .= ")";

			$fname = mysqli_real_escape_string($dbconnection, $fname);
			$lname = mysqli_real_escape_string($dbconnection, $lname);

			$result = mysqli_query($dbconnection, $query);
			// Test if there was a query error
			if ($result) {
				// Success
				echo "<p class='bg-success'>Success</p>";
			} else {
				// Failure
				die("Database query failed.  " . mysqli_error($dbconnection));
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="custom.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>Create Player</title>
</head>
<body>

	<div class="col-md-4">
		<?php echo $message; ?>
		<?php echo form_errors($errors); ?>

  		<a href="baseball.php">
		    <img alt="Baseball Bookmarker" src="logo.png">
		</a>

		<h1>Add New Player</h1>

		<form action="create_player.php" method="post">
			<div class="form-group">
				First Name: <input type="text" name="fname" value="" class="form-control" /><br />
				Last Name: <input type="text" name="lname" value="" class = "form-control" /><br />
				Team: <input type="text" name="team" value="" class="form-control" /><br />
				Position: <input type="text" name="position" class="form-control" value="" /><br />
				Number: <input type="text" name="number" value="" class="form-control" /><br />
			</div>
			<br />
			<input type="submit" name="submit" value="Submit" />
		</form>
	</div>

	<?php 
		  if ($errors){ 
		?>
			<audio autoplay="true" src="boo.mp3" />
		<?php
		  }
		?>
</body>

</html>