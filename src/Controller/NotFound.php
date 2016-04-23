<?php
namespace cbulock\task_tracker\Controller;

class NotFound extends Base {

	public function process() {
		$this->setTemplate('NotFound');
		header("HTTP/1.0 404");
	}

}