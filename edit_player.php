<?php
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

	require_once("included_functions.php");
	require_once("validation_functions.php");

	$errors = array();
	$message = "";

	if (isset($_POST['submit'])) {
		// form was submitted
		$playerId = $_POST["playerId"];
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
			// set values in database
			$query = "UPDATE player SET ";
			$query .= "fname = '{$fname}', ";
			$query .= "lname = '{$lname}', ";
			$query .= "team = '{$team}', ";
			$query .= "position = '{$position}', ";
			$query .= "number = '{$number}' ";
			$query .= "WHERE playerId = '{$playerId}'";

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
	} else {
		// $playerId = $_POST['editItem'];
		session_start();
		$temp = ($_SESSION['POST']);
		reset($temp);
		$playerId = array_values($temp)[0];
		unset($_SESSION['POST']);

		$query = "SELECT * FROM player ";
		$query .= "WHERE playerId = '{$playerId}'";
		$result = mysqli_query($dbconnection, $query);
		if (!$result) {
			die("Database query failed");
		}

		while($row = mysqli_fetch_assoc($result)) {
			$playerId = $row["playerId"];
			$fname = $row["fname"];
			$lname = $row["lname"];
			$team = $row["team"];
			$position = $row["position"];
			$number = $row["number"];
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

	<!-- Custom styles -->
	<link rel="stylesheet" type="text/css" href="custom.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<title>Edit Player</title>
</head>
<body>
	<div class="col-md-4">
		<?php echo $message; ?>
		<?php echo form_errors($errors); ?>

		<a href="baseball.php">
		    <img alt="Baseball Bookmarker" src="logo.png">
		</a>

		<h1>Edit Player</h1>
		<form action="edit_player.php" method="post" class="form-group">
			<input type="hidden" name="playerId" value=<?php echo $playerId ?> class="form-control"/><br />
			First Name: <input type="text" name="fname" value=<?php echo $fname ?> class="form-control"/><br />
			Last Name: <input type="text" name="lname" value=<?php echo $lname ?> class="form-control"/><br />
			Team: <input type="text" name="team" value=<?php echo $team ?> class="form-control"/><br />
			Position: <input type="text" name="position" value=<?php echo $position ?> class="form-control"/><br />
			Number: <input type="text" name="number" value=<?php echo $number ?> class="form-control"/><br />
			<br />
			<input type="submit" name="submit" value="Submit" />
		</form>
	</div>
</body>

</html>