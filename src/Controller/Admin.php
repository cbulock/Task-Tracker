<?php
namespace cbulock\task_tracker\Controller;

class Admin extends Base {

	public function process() {
		$this->setTemplate('Admin');

		$user = new \cbulock\task_tracker\User;

		$non_admins = $user->nonAdmins();
		foreach($non_admins as $key => $non_admin) {
			$non_admins[$key]['progress'] = $user->progress($non_admin['id']);
		}

		$this->addData(
			[
				'non_admin_users' => $non_admins
			]
		);

	}

}
