<?php

if (!$_COOKIE['user']) {
	header('Location: /who');
}

require_once('dbconnect.php');

$avail_query = "
	SELECT *, c.id AS chore_id
	FROM chores c
	LEFT JOIN (
		SELECT MAX(id) max_id, chore
		FROM history
		GROUP BY chore
	) history_new ON c.id = history_new.chore
	LEFT JOIN history AS h ON h.id = history_new.max_id
	WHERE ((DATE(NOW()) - h.date) - c.repeat) >= 0 OR h.date IS NULL
	ORDER BY c.priority DESC;
";

$s = $db->prepare($avail_query);
$s->execute();
$chores = $s->fetchAll();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>Available Chores</title>
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
		<h2>Available Chores</h2>
		<?
			foreach ($chores as $chore) {
				echo "<a href='/chore?id=" . $chore['chore_id'] . "' class='btn btn-default'>" . $chore['name'] . "</a>";
			}
		?>

		<a href='/your_history'>Your Chore History</a>
	</content>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	</body>

</html>
