<?php
namespace cbulock\task_tracker\Controller;

class Home extends Base {

	public function process() {
		$this->setTemplate('Home');

		$task = new \cbulock\task_tracker\Task;

		$this->addData(
			[
				'tasks' => $task->available()
			]
		);
	}

}