<?php
session_start();
// Get the DB connection info from the session
if (isset($_SESSION["serverName"]) && isset($_SESSION["connectionOptions"])) {
	$serverName = $_SESSION["serverName"];
	$connectionOptions = $_SESSION["connectionOptions"];
} else {
	// Session is not correctly set! Redirecting to start page
	session_unset();
	session_destroy();
	echo "Session is not correctly set! Clossing session and redirecting to start page in 3 seconds<br/>";
	die('<meta http-equiv="refresh" content="3; url=index.php" />');
	//header('Location: index.php');
	//die();
}
?>

<html>

<head>
	<style>
		table th {
			background: grey
		}

		table tr:nth-child(odd) {
			background: LightYellow
		}

		table tr:nth-child(even) {
			background: LightGray
		}
	</style>
</head>

<body>
	<table cellSpacing=0 cellPadding=5 width="100%" border=0>
		<tr>
			<td vAlign=top width=170><img height=91 alt=UCY src="images/ucy.jpg" width=94>
				<h5>
					<a href="http://www.ucy.ac.cy/">University of Cyprus</a><BR />
					<a href="http://www.cs.ucy.ac.cy/">Dept. of Computer Science</a>
				</h5>
			</td>
			<td vAlign=center align=middle>
				<h2>Welcome to the EPL342 project test page</h2>
			</td>
		</tr>
	</table>
	<hr>


	<?php
	$time_start = microtime(true);
	echo "Connecting to SQL server (" . $serverName . ")<br/>";
	echo "Database: " . $connectionOptions[Database] . ", SQL User: " . $connectionOptions[Uid] . "<br/>";
	//echo "Pass: " . $connectionOptions[PWD] . "<br/>";

	//Establishes the connection
	$conn = sqlsrv_connect($serverName, $connectionOptions);

	if (isset($_POST['connect'])) {
		echo "<br/>Trying to authenticate to T1-Users!<br/>";
		$tsql = "{call Authenticate(?,?)}";
		if (empty($_POST["username"]))
			echo "Username is empty!<br/>";
		if (empty($_POST["password"]))
			echo "Password is empty!<br/>";
		echo "Executing query: " . $tsql . ") with Username: " . $_POST["username"] . "<br/>";
		echo "Pass: " . $_POST["password"] . "<br/>";

		// Getting parameter from the http call and setting it for the SQL call
		$params = array(
			array($_POST["username"], SQLSRV_PARAM_IN),
			array($_POST["password"], SQLSRV_PARAM_IN)
		);

		$getResults = sqlsrv_query($conn, $tsql, $params);
		echo ("Results:<br/>");
		if ($getResults == FALSE)
			die(FormatErrors(sqlsrv_errors()));
			
		$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
		/* Arrays in PHP work like objects */
		echo (var_dump($row));

		/* Add authorised User credentials in SESSION */
		$UserID = $row["User ID"];
		$Privilages = $row["Privilages"];

		$_SESSION["User ID"] = $UserID;
		$_SESSION["Privilages"] = $Privilages;

		/* Free query  resources. */
		sqlsrv_free_stmt($getResults);

		/* Free connection resources. */
		sqlsrv_close($conn);

		$time_end = microtime(true);
		$execution_time = round((($time_end - $time_start) * 1000), 2);
		echo 'QueryTime: ' . $execution_time . ' ms';
	}
	?>
	<hr>
	<form action="authenticated.php" method="post" class="signin-form">
		<div class="form-group">
			<button type="submit" name="authorize" class="form-control btn btn-primary submit px-3">Authorize</button>
		</div>
	</form>


	<?php
	if (isset($_POST['disconnect'])) {
		echo "Clossing session and redirecting to start page";
		session_unset();
		session_destroy();
		die('<meta http-equiv="refresh" content="1; url=index.php" />');
	}
	?>

	<form method="post">
		<input type="submit" name="disconnect" value="Disconnect" />
	</form>

</body>

</html>