<?php
namespace cbulock\task_tracker\Controller;

class Edit extends Base {

	public function process() {

		$this->setTemplate('Edit');

		$task = new \cbulock\task_tracker\Task;

		$id = $this->route->get_data(1);

		$this->addData(
			[
				'task' => $task->get($id)
			]
		);
	}

}
