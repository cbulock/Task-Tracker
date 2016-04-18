<?php

if (!$_COOKIE['user']) {
	header('Location: /who');
}

require_once('dbconnect.php');

$query = "
	SELECT c.name chore_name, date, c.id chore_id
	FROM history h
	LEFT JOIN chores c ON c.id = h.chore
	LEFT JOIN users u ON u.id = h.user
	WHERE h.user = " . $_COOKIE['user'] .";
";

$s = $db->prepare($query);
$s->execute();
$logs = $s->fetchAll();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Your Chore History</title>
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
		<h2>Your Chore History</h2>
		<table class='table'>
		<?
			foreach ($logs as $log) {
				echo "<tr><td>" . $log['date'] . "</td><td><a href='/chore?id=" . $log['chore_id'] . "'>" . $log['chore_name'] . "</a></td></tr>";
			}
		?>
		</table>
	</content>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	</body>

</html>
