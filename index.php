<?php
session_start();
$sqlDBname = 'klarko01';
$sqlUser = 'klarko01';
$sqlPass = 'bhbmJcp2';

$_SESSION["serverName"] = "mssql.cs.ucy.ac.cy";
$_SESSION["connectionOptions"] = array(
	"Database" => $sqlDBname,
	"Uid" => $sqlUser,
	"PWD" => $sqlPass
);
?>

<html>

<head>
	<title>Team 1</title>
	<link rel="icon" href="https://i.imgur.com/70ln1bX.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(https://images.saymedia-content.com/.image/t_share/MTc4NzM1OTc4MzE0MzQzOTM1/how-to-create-cool-website-backgrounds-the-ultimate-guide.png);">
	<script>
		function myFunction() {
			var x = document.getElementById("password-field");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

	<style>
		.center {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			/* for IE 9 */
			-webkit-transform: translate(-50%, -50%);
			/* for Safari */

			/* optional size in px or %: */
			width: 100px;
			height: 100px;
		}

		.center-image {
			display: flex;
			justify-content: center;
		}
	</style>


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<div class="center-image">
							<img src="https://i.imgur.com/70ln1bX.png" alt="LOGO IMAGE">
						</div>
						<h3 class="mb-4 text-center">Observers System <br>Sign In</h3>
						<form action="auth.php" method="post" class="signin-form">
							<div class="form-group">
								<input name="username" type="text" class="form-control" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input name="password" id="password-field" type="password" class="form-control" placeholder="Password" required>
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="myFunction()"></span>
							</div>
							<div class="form-group">
								<button type="submit" name="connect" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>

</html>