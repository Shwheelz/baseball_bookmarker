<?php
	// 1. Create a database connection
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
?>

<?php
	if (isset($_POST['editItem'])) {	
		session_start();
		$_SESSION['POST'] = $_POST;
		header("Location: edit_player.php");
		exit();	
	}
?>

<?php
	// delete player from his id when delete button is clicked
	if (isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem'])) {
		$idToDelete = $_POST['deleteItem'];
		$query = "DELETE FROM player ";
		$query .= "WHERE playerId = '{$idToDelete}' ";
		$query .= "LIMIT 1";

		$result = mysqli_query($dbconnection, $query);
		// Test if there was a query error
		if ($result && mysqli_affected_rows($dbconnection) == 1) {
			// Success
			echo "<p class='bg-success'>Success</p>";
		} else {
			// Failure
			die("Database query failed.  " . mysqli_error($dbconnection));
		}
	}
?>

<?php
	// Perform database query
	$query = "SELECT * FROM player";
	$result = mysqli_query($dbconnection, $query);
	if (!$result) {
		die("Database query failed");
	}
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<!-- Custom styles -->
		<link rel="stylesheet" type="text/css" href="custom.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<title>Baseball Page</title>
	</head
>	<body>
    	<div class="col-md-12">
			<a href="baseball.php">
		    	<img alt="Baseball Bookmarker" src="logo.png">
			</a>
			<form action="baseball.php" method="post">
				<table class="table">
					<?php
						// Use return data with mysqli_fetch_assoc
						while($row = mysqli_fetch_assoc($result)) {
							// output data from each row
					?>
					<tr>
						<td><?php echo $row["number"]; ?></td>
						<td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
						<td><?php echo $row["team"]; ?></td>
						<td><?php echo $row["position"]; ?></td>
						<td><?php echo '<a href="https://en.wikipedia.org/wiki/'.$row["fname"].'_'.$row["lname"].'"> Wiki Page </a>' ?></td>
						<td><?php echo '<button type="submit" name="editItem" value="'.$row['playerId'].'" class="btn btn-info">Edit</button>' ?></td>
						<td><?php echo '<button type="submit" name="deleteItem" value="'.$row['playerId'].'" class="btn btn-danger">Delete</button>' ?></td>
					</tr>
					<?php 
						}
					?>
				</table>
			</form>

			<form action="create_player.php" method="get">
				<button type="submit" name="createItem" value="" class="btn btn-success">Add a Player</button>
			</form>

			<?php
				// Release returned data
				mysqli_free_result($result);
			?>
		</div>
	</body>
</html>

<?php
	// Close the database connection
	mysqli_close($dbconnection);
?>
