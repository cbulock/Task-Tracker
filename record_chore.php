<?php

require_once('dbconnect.php');

$params = [
	':chore'	=> $_POST['chore'],
	':user'		=> $_COOKIE['user']
];

$query = "INSERT INTO history (`chore`, `user`, `date`) VALUES (:chore, :user, DATE(NOW()))";

$s = $db->prepare($query);
$s->execute($params);

header('Location: /');
