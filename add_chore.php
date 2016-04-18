<?php

require_once('dbconnect.php');

$params = [
	':name' 		=> $_POST['name'],
	':desc' 		=> $_POST['desc'],
	':priority' => $_POST['priority'],
	':repeat' 	=> $_POST['repeat']
];

$query = "INSERT INTO chores (`name`, `desc`, `priority`, `repeat`) VALUES (:name, :desc, :priority, :repeat)";

$s = $db->prepare($query);
$s->execute($params);

header('Location: /add');
