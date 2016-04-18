<?php

require_once('dbconnect.php');

$query = "
	SELECT *
	FROM users;
";

$s = $db->prepare($query);
$s->execute();
$users = $s->fetchAll();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Who Are You?</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">

		<link rel='shortcut icon' type='image/png' href='/img/32.png' />
		<link rel="apple-touch-icon" href="/img/60.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="/img/76.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="/img/120.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="/img/152.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="/img/180.png" />
		<link rel="icon" sizes="192x192" href="/img/192.png" />
	</head>

	<body>

	<content>
		<h2>Who Are You?</h2>
		<?
			foreach ($users as $user) {
				echo "<a href='/set_user.php?id=" . $user['id'] . "' class='btn btn-default'>" . $user['name'] . "</a>";
			}
		?>
	</content>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	</body>

</html>
