<?php

if (!$_COOKIE['user']) {
	header('Location: /who');
}

require_once('dbconnect.php');

$query = "
	SELECT *
	FROM chores
	WHERE id = :id;
";

$params = [
	':id' => $_GET['id']
];

$s = $db->prepare($query);
$s->execute($params);
$chore = $s->fetchAll()[0];
?>
<!DOCTYPE html>
<html>

	<head>
		<title><?= $chore['name'] ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/chore.css">

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
		<h2><?= $chore['name'] ?></h2>

		<p class='lead'><?= $chore['desc'] ?></p>

		<p>This chore is available to do every <?= $chore['repeat'] ?> days.</p>
		<form action='record_chore.php' method='post'>
			<input type='hidden' name='chore' value='<?= $chore['id'] ?>'>
			<button class="btn btn-primary" type='submit'>Finished This Chore</button>
		</form>
	</content>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	</body>

</html>
