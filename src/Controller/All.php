<?php
namespace cbulock\task_tracker\Controller;

class All extends Base {

	public function process() {
		$this->setTemplate('All');

		$task = new \cbulock\task_tracker\Task;

		$this->addData(
			[
				'tasks' => $task->all()
			]
		);
	}

}