<?php
namespace cbulock\task_tracker\Controller;

class Who extends Base {

	public function process() {
		$this->setTemplate('Who');

		$user = new \cbulock\task_tracker\User;

		$this->addData(
			[
			 'users' => $user->all()
		 ]
	 );
 }

}
