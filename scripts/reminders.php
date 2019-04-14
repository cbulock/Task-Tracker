<?php
namespace cbulock\task_tracker;

require_once('../vendor/autoload.php');

$user = new User;

$non_admins = $user->nonAdmins();
foreach($non_admins as $non_admin) {
	$user->messageProgress($non_admin['id']);
}
