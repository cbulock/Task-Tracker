<?php
namespace cbulock\task_tracker\Controller;

class Manifest extends Base {

	public function process() {

		$this->setTemplate('Manifest');
		$this->setContentType('Content-type: application/json; charset=UTF-8');

	}

}