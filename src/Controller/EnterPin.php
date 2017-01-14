<?php
namespace cbulock\task_tracker\Controller;

class EnterPin extends Base {

	public function process() {

		$this->setTemplate('EnterPin');

		$this->addData(
			[
				'id' => $_GET['user']
			]
		);
	}

}