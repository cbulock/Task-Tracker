<?php
namespace cbulock\task_tracker\Controller;

class Overrides extends Base {

	public function process() {

		$this->setTemplate('Overrides');

		$user = new \cbulock\task_tracker\User;

		$this->addData(
			[
				'users' => $user->all()
			]
		);
	}

}
