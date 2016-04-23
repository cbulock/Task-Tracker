<?php
namespace cbulock\task_tracker\Controller;

class Home extends Base {

	public function process() {
		$this->setTemplate('Home');

		$chore = new \cbulock\task_tracker\Chore;

		$this->addData(
			[
				'chores' => $chore->available()
			]
		);
	}

}