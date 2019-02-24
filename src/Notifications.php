<?php
namespace cbulock\task_tracker;

/**
 * Send notifications to users.
 *
 */
class Notifications {

	public function __construct() {
	}

	public function sendMessage($user_id, $message, $type='text') {
		$notifier_class = '\cbulock\task_tracker\Notifications\\' . ucfirst($type);
		$notifier =  new $notifier_class;

		$notifier->send($user_id, $message);
	}

	public function messageAdmins($message, $type='text') {
		$admins = (new User)->admins();

		foreach ($admins as $admin) {
			$this->sendMessage($admin['id'], $message, $type);
		}
	}
	
}