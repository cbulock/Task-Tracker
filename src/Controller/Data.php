<?php
namespace cbulock\task_tracker\Controller;

class Data extends Base {

	public function process() {

		$this->setTemplate('Data');

		$task = new \cbulock\task_tracker\Task;
		$history = new \cbulock\task_tracker\History;

		$id = $this->route->get_data(1);

		$this->addData(
			[
				'task' => $task->get($id),
				'history' => $history->by_task($id)
			]
		);
	}

}