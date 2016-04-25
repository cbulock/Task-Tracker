<?php
namespace cbulock\task_tracker\Controller;

class Chore extends Base {

	public function process() {

		$this->setTemplate('Chore');

		$chore = new \cbulock\task_tracker\Chore;

		$id = $this->route->get_data(1);

		$this->addData(
			[
				'chore' => $chore->get($id)
			]
		);
	}

}
